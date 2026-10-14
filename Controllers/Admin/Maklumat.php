<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\profileModel;

class Maklumat extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new profileModel();
    }

    public function index()
    {
        $data['maklumat'] = $this->profileModel->select()->where('visimisi_kat_id', 3)->findAll();
        $data['title'] = 'Kelola Maklumat';
        
        return view('admin/maklumat/index', $data);
    }
    public function edit($id = null)
    {
        $data['maklumat'] = $this->profileModel->find($id);
        
        if (!$data['maklumat']) {
            return redirect()->to('/admin/maklumat')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Maklumat';
        return view('admin/maklumat/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->profileModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/maklumat')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'visimisi_desc'   => [
                'rules' =>'is_image[visimisi_desc]|max_size[visimisi_desc,512]', 'errors' => [
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('visimisi_desc');
        if ($file && $file->isValid() && !$file->hasMoved()) {        
            $result = $this->updateWithImage(
                $this->profileModel,
                $id,
                [],
                $file,
                WRITEPATH . '../public/uploads/images/profile',
                'visimisi_desc',
                $existing['visimisi_desc']
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }
            return redirect()->to('/admin/maklumat')->with('success', 'Maklumat berhasil diperbarui!');
        }
    }
}