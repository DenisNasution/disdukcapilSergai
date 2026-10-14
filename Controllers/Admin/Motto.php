<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\profileModel;

class Motto extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new profileModel();
    }

        public function index()
    {
        $data['motto'] = $this->profileModel->select()->where('visimisi_kat_id', 2)->findAll();
        $data['title'] = 'Kelola Motto';
        
        return view('admin/motto/index', $data);
    }   

        public function edit($id = null)
    {
        $data['motto'] = $this->profileModel->find($id);
        
        if (!$data['motto']) {
            return redirect()->to('/admin/motto')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Motto';
        return view('admin/motto/edit', $data);
    }
          public function update($id = null)
    {
        $existing = $this->profileModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/motto')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'visimisi_desc'  => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Motto wajib diisi.',
                    'min_length' => 'Motto minimal {param} karakter.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $result = $this->updateSimple(
            $this->profileModel, 
            $id, 
            [
                'visimisi_desc' => $this->request->getPost('visimisi_desc'),
            ]
        );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/admin/motto')->with('success', 'Motto berhasil diperbarui!');
    }
}