<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\kerjaSamaModel;

class KerjaSama extends BaseController
{
    protected $kerjaSamaModel;

    public function __construct()
    {
        $this->kerjaSamaModel = new kerjaSamaModel();
    }

public function index()
    {
        $data['kerjaSama'] = $this->kerjaSamaModel->orderBy('id')->findAll();
        $data['title'] = 'Kelola Data Kerja Sama';
        
        return view('admin/kerjasama/index', $data);
    }

     public function store()
    {
    $rules = [
        'kerjaSama_img'   => [
                'rules' =>'uploaded[kerjaSama_img]|is_image[kerjaSama_img]|max_size[kerjaSama_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
        ]
        ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $file = $this->request->getFile('kerjaSama_img');
    
    if ($file->isValid() && !$file->hasMoved()) {
        $result = $this->saveWithImage(
            $this->kerjaSamaModel,
            [
                'kerjaSama_id'   => $this->kerjaSamaModel->generateId(),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/kerjasama',
            'kerjaSama_img'
        );

        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }
        return redirect()->to('/admin/kerjasama')->with('success', 'Data Kerja Sama berhasil ditambahkan!');
    }

}

public function create()
    {
        $data['title'] = 'Tambah Data Kerja Sama';
        return view('admin/kerjasama/create', $data);
    }

public function edit($id = null)
    {
        $data['kerjaSama'] = $this->kerjaSamaModel->find($id);
        
        if (!$data['kerjaSama']) {
            return redirect()->to('/admin/kerjasama')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Kerja Sama';
        return view('admin/kerjasama/edit', $data);
    }
public function update($id = null)
    {
    $existing = $this->kerjaSamaModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/kerjasama')->with('error', 'Data tidak ditemukan');
        }

    $rules = [
        'kerjaSama_img'   => [
            'rules' =>'is_image[kerjaSama_img]|max_size[kerjaSama_img,512]', 'errors' => [
                'max_size' => 'Ukuran file maximal 500 Kb',
                'is_image' => 'File harus berjenis gambar'
                ], 
            ]         
        ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }   

    $file = $this->request->getFile('kerjaSama_img');
    $result = $this->updateWithImage(
            $this->kerjaSamaModel,
            $id,
            [],
            $file,
            WRITEPATH . '../public/uploads/images/kerjasama',
            'kerjaSama_img',
            $existing['kerjaSama_img']
    );

    if (!$result['success']) {
    return redirect()->back()->withInput()->with('error', $result['error']);
    }
        
    return redirect()->to('/admin/kerjasama')->with('success', 'Data Kerja Sama berhasil diperbarui!');
}
public function delete($id = null)
    {
        $existing = $this->kerjaSamaModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/kerjasama')->with('error', 'Data tidak ditemukan');
        }
    $oldImage = $existing['kerjaSama_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/kerjasama/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/kerjasama/' . $oldImage);
        }
        $this->kerjaSamaModel->delete($id);
        return redirect()->to('/admin/kerjasama')->with('success', 'Data Kerja Sama berhasil dihapus');
    }
}