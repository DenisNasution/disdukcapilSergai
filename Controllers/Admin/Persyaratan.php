<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\persyaratanModel;

class Persyaratan extends BaseController
{
    protected $persyaratanModel;

    public function __construct()
    {
        $this->persyaratanModel = new persyaratanModel();
    }

    public function index()
    {
        $perPage = $this->request->getVar('perPage') ?? 10;
        $data['persyaratan'] = $this->persyaratanModel->orderBy('id')->paginate($perPage, 'default');
        $data['pager'] = $this->persyaratanModel->pager;
        $data['title'] = 'Kelola Data Kepuasan Masyarakat';
        
        return view('admin/persyaratan/index', $data);
    }

    public function store()
    {
        $rules = [
            'persyaratan_name'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Jenis Persyaratan wajib diisi.',
                    'min_length' => 'Jenis Persyaratan minimal {param} karakter.',
                ],
            ],
            'persyaratan_img'   => [
                    'rules' =>'uploaded[persyaratan_img]|is_image[persyaratan_img]|max_size[persyaratan_img,512]', 'errors' => [
                        'uploaded'   => 'Gambar Harus Diisi.',
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('persyaratan_img');
           
        if ($file->isValid() && !$file->hasMoved()) {

            $result = $this->saveWithImage(
                $this->persyaratanModel,
                [
                    'persyaratan_id'   => $this->persyaratanModel->generateId(),
                    'persyaratan_name' => $this->request->getPost('persyaratan_name'),
                ],
                $file,
                WRITEPATH . '../public/uploads/images/syarat',
                'persyaratan_img'
                );
            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }   
        
            return redirect()->to('/admin/persyaratan?page=6')->with('success', 'Data Kepuasan Masyarakat berhasil ditambahkan!');
        }
}

public function create()
    {
        $data['title'] = 'Tambah Data Persyaratan Adminduk';
        return view('admin/persyaratan/create', $data);
    }

    public function edit($id = null)
    {
        $data['persyaratan'] = $this->persyaratanModel->find($id);
        
        if (!$data['persyaratan']) {
            return redirect()->to('/admin/persyaratan')->with('error', 'Data tidak ditemukan');
        }
         $data['currentPage'] = $this->request->getVar('page') ?? 1;
        
        $data['title'] = 'Edit Data Persyaratan Adminduk';
        return view('admin/persyaratan/edit', $data);
    }
        public function update($id = null)
    {
            $existing = $this->persyaratanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/persyaratan')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
        'persyaratan_name'  => [
            'rules'  => 'required|min_length[4]',
            'errors' => [
                'required'   => 'Jenis Persyaratan wajib diisi.',
                'min_length' => 'Jenis Persyaratan minimal {param} karakter.',
            ],
            ],
        'persyaratan_img'   => [
            'rules' =>'is_image[persyaratan_img]|max_size[persyaratan_img,512]', 
            'errors' => [
                'max_size' => 'Ukuran file maximal 500 Kb',
                'is_image' => 'File harus berjenis gambar'
            ], 
        ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('persyaratan_img');
        $result = $this->updateWithImage(
            $this->persyaratanModel,
            $id,
            [
                'persyaratan_name' => $this->request->getPost('persyaratan_name'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/syarat',
            'persyaratan_img',
            $existing['persyaratan_img']
        );

        if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
        }
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/persyaratan?page=' . $page)->with('success', 'Data Persyaratan Adminduk berhasil diperbarui!');
    }
    public function delete($id = null)
    {
                $existing = $this->persyaratanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/persyaratan')->with('error', 'Data tidak ditemukan');
        }
            $oldImage = $existing['persyaratan_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/syarat/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/syarat/' . $oldImage);
        }
        $this->persyaratanModel->delete($id);
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/persyaratan?page=' . $page)->with('success', 'Data Persyaratan Adminduk berhasil dihapus');
    }
}