<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\pengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new pengaduanModel();
    }

        public function index()
    {
        $data['pengaduan'] = $this->pengaduanModel->findAll();
        $data['title'] = 'Kelola Data Pengaduan';
        
        return view('admin/pengaduan/index', $data);
    }
    public function edit($id = null)
    {
        $data['pengaduan'] = $this->pengaduanModel->find($id);
        
        if (!$data['pengaduan']) {
            return redirect()->to('/admin/pengaduan')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Pengaduan';
        return view('admin/pengaduan/edit', $data);
    }
          public function update($id = null)
    {
                $existing = $this->pengaduanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/pengaduan')->with('error', 'Data tidak ditemukan');
        }

            $rules = [
            'pengaduan_desc'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Keterangan wajib diisi.',
                    'min_length' => 'Keterangan minimal {param} karakter.',
                ],
            ],
            'pengaduan_title'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Judul wajib diisi.',
                    'min_length' => 'Judul minimal {param} karakter.',
                ],
            ],
            'pengaduan_img'   => [
                    'rules' =>'is_image[pengaduan_img]|max_size[pengaduan_img,512]', 'errors' => [
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]     
            ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

            $data = [
                'pengaduan_desc' => $this->request->getPost('pengaduan_desc'),
                'pengaduan_title'  => $this->request->getPost('pengaduan_title'),
            ];

            $file = $this->request->getFile('pengaduan_img');
            $result = $this->updateWithImage(
            $this->pengaduanModel,
            $id,
            [
                'pengaduan_desc' => $this->request->getPost('pengaduan_desc'),
                'pengaduan_title'  => $this->request->getPost('pengaduan_title'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/pengaduan',
            'pengaduan_img',
            $existing['pengaduan_img']
        );

        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }
                
        return redirect()->to('/admin/pengaduan')->with('success', 'Data Pengaduan berhasil diperbarui!');
    }
}