<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\pendudukModel;

class DataPenduduk extends BaseController
{
    protected $pendudukModel;

    public function __construct()
    {
        $this->pendudukModel = new pendudukModel();
    }

    public function index()
    {
        $data['datapenduduk'] = $this->pendudukModel->orderBy('id', 'ASC')->findAll();
        $data['title'] = 'Kelola Data Penduduk';
        
        return view('admin/datapend/index', $data);
    }   

    public function edit($id = null)
    {
        $data['datapenduduk'] = $this->pendudukModel->find($id);
        
        if (!$data['datapenduduk']) {
            return redirect()->to('/admin/datapend')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Penduduk';
        return view('admin/datapend/edit', $data);
    }
    public function update($id = null)
    {
        $rules = [
        'data_penduduk_jmlh' => 'required'
        ];
        $existing = $this->pendudukModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/datapend')->with('error', 'Data tidak ditemukan');
        }
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $result = $this->updateSimple(
            $this->pendudukModel, 
            $id, 
            [
                'data_penduduk_jmlh' => $this->request->getPost('data_penduduk_jmlh'),
            ]
        );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/admin/datapend')->with('success', 'Data Penduduk berhasil diperbaharui!');
    }
}