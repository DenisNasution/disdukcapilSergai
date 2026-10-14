<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\jadiTauModel;

class JadiTau extends BaseController
{
    protected $jadiTauModel;

    public function __construct()
    {
        $this->jadiTauModel = new jadiTauModel();
    }

        public function index()
    {
        $data['jaditau'] = $this->jadiTauModel->orderBy('id', 'ASC')->findAll();
        $data['title'] = 'Kelola Data Jadi Tau';
        
        return view('admin/jaditau/index', $data);
    }

     public function store()
    {
        $rules = [
            'jadiTau_desc'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Keterangan wajib diisi.',
                    'min_length' => 'Keterangan minimal {param} karakter.',
                ],
            ],
            'jadiTau_name'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Judul wajib diisi.',
                    'min_length' => 'Judul minimal {param} karakter.',
                ],
            ],
            'jadiTau_img'   => [
                    'rules' =>'uploaded[jadiTau_img]|is_image[jadiTau_img]|max_size[jadiTau_img,512]', 'errors' => [
                        'uploaded'   => 'Gambar Harus Diisi.',
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('jadiTau_img');
        if ($file->isValid() && !$file->hasMoved()) {
        $result = $this->saveWithImage(
            $this->jadiTauModel,
            [
                'jadiTau_id'   => $this->jadiTauModel->generateId(),
                'jadiTau_desc' => $this->request->getPost('jadiTau_desc'),
                'jadiTau_name'  => $this->request->getPost('jadiTau_name'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/jadiTau',
            'jadiTau_img'
            );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }        

        return redirect()->to('/admin/jaditau')->with('success', 'Data Jadi Tau berhasil ditambahkan!');
        }

    }

        public function create()
    {
        $data['title'] = 'Tambah Data Jadi Tau';
        return view('admin/jaditau/create', $data);
    }

        public function edit($id = null)
    {
        $data['jaditau'] = $this->jadiTauModel->find($id);
        
        if (!$data['jaditau']) {
            return redirect()->to('/admin/jaditau')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Jadi Tau';
        return view('admin/jaditau/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->jadiTauModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/jaditau')->with('error', 'Data tidak ditemukan');
        }

            $rules = [
            'jadiTau_desc'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Keterangan wajib diisi.',
                    'min_length' => 'Keterangan minimal {param} karakter.',
                ],
            ],
            'jadiTau_name'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Judul wajib diisi.',
                    'min_length' => 'Judul minimal {param} karakter.',
                ],
            ],
            'jadiTau_img'   => [
                    'rules' =>'is_image[jadiTau_img]|max_size[jadiTau_img,512]', 'errors' => [
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
            
            ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('jadiTau_img');
        $result = $this->updateWithImage(
            $this->jadiTauModel,
            $id,
            [
                'jadiTau_desc' => $this->request->getPost('jadiTau_desc'),
                'jadiTau_name'  => $this->request->getPost('jadiTau_name'), 
            ],
            $file,
            WRITEPATH . '../public/uploads/images/jadiTau',
            'jadiTau_img',
            $existing['jadiTau_img']
        );

        if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
        }
        

        return redirect()->to('/admin/jaditau')->with('success', 'Data Jadi Tau berhasil diperbarui!');
    }
        public function delete($id = null)
    {
        $existing = $this->jadiTauModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/jaditau')->with('error', 'Data tidak ditemukan');
        }
                $oldImage = $existing['jadiTau_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/jadiTau/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/jadiTau/' . $oldImage);
        }
        $this->jadiTauModel->delete($id);
        return redirect()->to('/admin/jaditau')->with('success', 'Data Jadi Tau berhasil dihapus');
    }
}