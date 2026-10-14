<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\profileModel;

class Visimisi extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new profileModel();
    }

    public function index()
    {
        $data['visimisi'] = $this->profileModel->select()->where('visimisi_kat_id', 1)->findAll();
        $data['title'] = 'Kelola Visi Misi';
        
        return view('admin/visimisi/index', $data);
    }   

    public function edit($id = null)
    {
        $data['visimisi'] = $this->profileModel->find($id);
        
        if (!$data['visimisi']) {
            return redirect()->to('/admin/visimisi')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Visimisi';
        return view('admin/visimisi/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->profileModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/visimisi')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'visimisi_desc'  => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Visimisi wajib diisi.',
                    'min_length' => 'visimisi minimal {param} karakter.',
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

        return redirect()->to('/admin/visimisi')->with('success', 'Visi Misi berhasil diperbarui!');
    }
}