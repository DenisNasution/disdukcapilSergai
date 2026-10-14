<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\penghargaanModel;

class Penghargaan extends BaseController
{
    protected $penghargaanModel;

    public function __construct()
    {
        $this->penghargaanModel = new penghargaanModel();
    }

public function index()
    {
        $data['penghargaan'] = $this->penghargaanModel->orderBy('id')->findAll();
        $data['title'] = 'Kelola Penghargaan';
        
        return view('admin/penghargaan/index', $data);
    }

     public function store()
    {
        $rules = [
            'penghargaan_img'   => [
                'rules' =>'uploaded[penghargaan_img]|is_image[penghargaan_img]|max_size[penghargaan_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]
            
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('penghargaan_img');

        if ($file->isValid() && !$file->hasMoved()) {
            $result = $this->saveWithImage(
                $this->penghargaanModel,
                [
                    'penghargaan_id'   => $this->penghargaanModel->generateId(),
                ],
                $file,
                WRITEPATH . '../public/uploads/images/penghargaan',
                'penghargaan_img'
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }

            return redirect()->to('/admin/penghargaan')->with('success', 'Penghargaan berhasil ditambahkan!');
        }

    }

public function create()
    {
        $data['title'] = 'Tambah Penghargaan';
        return view('admin/penghargaan/create', $data);
    }

public function edit($id = null)
    {
        $data['penghargaan'] = $this->penghargaanModel->find($id);
        
        if (!$data['penghargaan']) {
            return redirect()->to('/admin/penghargaan')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Penghargaan';
        return view('admin/penghargaan/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->penghargaanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/penghargaan')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'penghargaan_img'   => [
                'rules' =>'uploaded[penghargaan_img]|is_image[penghargaan_img]|max_size[penghargaan_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]        
            ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('penghargaan_img');
        $data['penghargaan_img'] = "";
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $result = $this->updateWithImage(
                $this->penghargaanModel,
                $id,
                [],
                $file,
                WRITEPATH . '../public/uploads/images/penghargaan',
                'penghargaan_img',
                $existing['penghargaan_img']
            );

            if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
            }
            
            return redirect()->to('/admin/penghargaan')->with('success', 'Penghargaan berhasil diperbarui!');
        }

}
public function delete($id = null)
    {
            $existing = $this->penghargaanModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/penghargaan')->with('error', 'Data tidak ditemukan');
        }
        $oldImage = $existing['penghargaan_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/penghargaan/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/penghargaan/' . $oldImage);
        }
        $this->penghargaanModel->delete($id);
        return redirect()->to('/admin/penghargaan')->with('success', 'Penghargaan berhasil dihapus');
    }
}