<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\kepegawaianModel;

class DataPegawai extends BaseController
{
    protected $kepegawaianModel;

    public function __construct()
    {
        $this->kepegawaianModel = new kepegawaianModel();
    }

    public function index()
    {
        $data['datapegawai'] = $this->kepegawaianModel->getDataPegawai();
        $data['title'] = 'Kelola Data Pegawai';
        
        return view('admin/datapeg/index', $data);
    }   

    public function edit($id = null)
    {
        $data['datapegawai'] = $this->kepegawaianModel->getDataPegawaiDetail($id);
        
        if (!$data['datapegawai']) {
            return redirect()->to('/admin/datapeg')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Pegawai';
        return view('admin/datapeg/edit', $data);
    }
    public function update($id = null)
    {
        $rules = [
            'data_pegawai_jumlah' => 'required'
        ];
        $existing = $this->kepegawaianModel->getDataPegawaiDetail($id)[0];
        if (!$existing) {
            return redirect()->to('/admin/datapeg')->with('error', 'Data tidak ditemukan');
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }        
        $result = $this->updateSimple(
            $this->kepegawaianModel, 
            $id, 
            [
                'data_pegawai_jumlah' => $this->request->getPost('data_pegawai_jumlah')
            ],
            function($model,$id, $data) {
                    return $model->updateDataPegawai($id, $data);
            }
        );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/admin/datapeg')->with('success', 'Data Pegawai berhasil diperbaharui!');
    }
}