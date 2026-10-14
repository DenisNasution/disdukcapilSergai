<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\kepuasanModel;

class Kepuasan extends BaseController
{
    protected $kepuasanModel;

    public function __construct()
    {
        $this->kepuasanModel = new kepuasanModel();
    }

    public function index()
    {
        $data['kepuasan'] = $this->kepuasanModel->orderBy('id', 'ASC')->findAll();
        $data['title'] = 'Kelola Data Kepuasan Masyarakat';
        
        return view('admin/kepuasan/index', $data);
    }

    public function store()
    {
        $rules = [
            'kepuasan_desc'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Periode wajib diisi.',
                    'min_length' => 'Periode minimal {param} karakter.',
                ],
            ],
            'kepuasan_score'  => [
                'rules'  => 'required|min_length[2]|max_length[7]',
                'errors' => [
                    'required'   => 'Nilai wajib diisi.',
                    'min_length' => 'Nilai minimal {param} karakter.',
                ],
            ],
            'kepuasan_img'   => [
                'rules' =>'uploaded[kepuasan_img]|is_image[kepuasan_img]|max_size[kepuasan_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('kepuasan_img');

        if ($file->isValid() && !$file->hasMoved()) {
            $result = $this->saveWithImage(
            $this->kepuasanModel,
            [
                'kepuasan_id'    => $this->kepuasanModel->generateId(),
                'kepuasan_desc'  => $this->request->getPost('kepuasan_desc'),
                'kepuasan_score' => $this->request->getPost('kepuasan_score'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/kepuasan',
            'kepuasan_img'
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }
            return redirect()->to('/admin/kepuasan')->with('success', 'Data Kepuasan Masyarakat berhasil ditambahkan!');
        }

    }

    public function create()
        {
            $data['title'] = 'Tambah Data Kepuasan Masyarakat';
            return view('admin/kepuasan/create', $data);
        }

    public function edit($id = null)
    {
        $data['kepuasan'] = $this->kepuasanModel->find($id);
        
        if (!$data['kepuasan']) {
            return redirect()->to('/admin/kepuasan')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Kepuasan Masyarakat';
        return view('admin/kepuasan/edit', $data);
    }
    public function update($id = null)
    {
        $rules = [
            'kepuasan_desc'  => [
            'rules'  => 'required|min_length[4]',
            'errors' => [
                'required'   => 'Periode wajib diisi.',
                'min_length' => 'Periode minimal {param} karakter.',
            ],
            ],
            'kepuasan_score'  => [
                'rules'  => 'required|min_length[2]|max_length[7]',
                'errors' => [
                    'required'   => 'Nilai wajib diisi.',
                    'min_length' => 'Nilai minimal {param} karakter.',
                ],
            ],
            'kepuasan_img'   => [
                    'rules' =>'is_image[kepuasan_img]|max_size[kepuasan_img,512]', 'errors' => [
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];
        $existing = $this->kepuasanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/kepuasan')->with('error', 'Data tidak ditemukan');
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('kepuasan_img');
        $result = $this->updateWithImage(
            $this->kepuasanModel,
            $id,
            [
                'kepuasan_desc'  => $this->request->getPost('kepuasan_desc'),
                'kepuasan_score' => $this->request->getPost('kepuasan_score'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/kepuasan',
            'kepuasan_img',
            $existing['kepuasan_img']
        );

        if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/admin/kepuasan')->with('success', 'Data Kepuasan Masyarakat berhasil diperbarui!');
    }
    public function delete($id = null)
        {
            $existing = $this->kepuasanModel->find($id);
            if (!$existing) {
                return redirect()->to('/admin/kepuasan')->with('error', 'Data tidak ditemukan');
            }
        $oldImage = $existing['kepuasan_img'];
            if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/kepuasan/' . $oldImage)) {
                unlink(WRITEPATH . '../public/uploads/images/kepuasan/' . $oldImage);
            }
            $this->kepuasanModel->delete($id);
            return redirect()->to('/admin/kepuasan')->with('success', 'Data Kepuasan Masyarakat berhasil dihapus');
        }
    }