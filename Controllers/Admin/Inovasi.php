<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\inovasiModel;

class Inovasi extends BaseController
{
    protected $inovasiModel;

    public function __construct()
    {
        $this->inovasiModel = new inovasiModel();
    }

    public function index($id = null, $menu = 'kolaborasi')
    {
        $allowed = ['kolaborasi', 'kinerja', 'kompetensi'];
        if (!in_array($menu, $allowed)) {
            $menu = 'kolaborasi';
        }
        $data['activeStatus'] = $menu;
        $data['main_name'] = $this->inovasiModel->find($id);
        $data['inovasi_id'] = $id;

        $data['main_item'] = $this->inovasiModel->getInovasiWithList($id);
        $data['title'] = 'Kelola Data Inovasi' . " " .$data['main_name']['inovasi_name'] ;
        return view('admin/inovasi/index', $data);
    }

     public function store()
    {
        $rules = [
            'inovasi_id'  => 'required|numeric|max_length[4]',
            'inovasi_list_img'   => [
                'rules' =>'uploaded[inovasi_list_img]|is_image[inovasi_list_img]|max_size[inovasi_list_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]
            
        ];
        $menu = '';
        if ($this->request->getPost('inovasi_id') == 1) {
            $menu = 'kolaborasi';
            
        }elseif($this->request->getPost('inovasi_id') == 2){
            $menu = 'kinerja';
        }elseif($this->request->getPost('inovasi_id') == 3){
            $menu = 'kompetensi';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }        

        $file = $this->request->getFile('inovasi_list_img');

        if ($file->isValid() && !$file->hasMoved()) {
            $result = $this->saveWithImage(
                $this->inovasiModel,
                [
                    'inovasi_list_id'   => $this->inovasiModel->generateId(),
                    'inovasi_id' => $this->request->getPost('inovasi_id'),
                ],
                $file,
                WRITEPATH . '../public/uploads/images/inovasi',
                'inovasi_list_img',
                function($model, $data) {
                    return $model->saveinovasiList($data);
                }
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }

            return redirect()->to('/admin/inovasi/' . $this->request->getPost('inovasi_id') . '/' . $menu )->with('success', 'Data Inovasi berhasil ditambahkan!');
        }

    }

    public function create($id = null)
    {
        $data['inovasi'] = $this->inovasiModel->findAll();
        $data['inovasi_id'] = $id;
        $data['title'] = 'Tambah Data inovasi';
        return view('admin/inovasi/create', $data);
    }

    public function edit($id = null)
    {
            $data['inovasi'] = $this->inovasiModel->findAll();
        $data['inovasi_detail'] = $this->inovasiModel->getInovasiDetail($id)[0];
        
        if (!$data['inovasi_detail']) {
            return redirect()->to('/admin/inovasi')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Inovasi';
    
        return view('admin/inovasi/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->inovasiModel->getInovasiDetail($id)[0];
        if (!$existing) {
            return redirect()->to('/admin/inovasi/1')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
        'inovasi_id'  => 'required|numeric|max_length[4]',
        'inovasi_list_img'   => [
                    'rules' =>'is_image[inovasi_list_img]|max_size[inovasi_list_img,512]', 'errors' => [
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];

        $menu = '';
        if ($this->request->getPost('inovasi_id') == 1) {
            $menu = 'kolaborasi';
            
        }elseif($this->request->getPost('inovasi_id') == 2){
            $menu = 'kinerja';
        }elseif($this->request->getPost('inovasi_id') == 3){
            $menu = 'kompetensi';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'inovasi_id' => $this->request->getPost('inovasi_id'),
        ];
        $file = $this->request->getFile('inovasi_list_img');
        $result = $this->updateWithImage(
            $this->inovasiModel,
            $id,
            $data,
            $file,
            WRITEPATH . '../public/uploads/images/inovasi',
            'inovasi_list_img',
            $existing['inovasi_list_img'],
            function($model, $id, $data) {
                return $model->updateInovasiList($id, $data);
            }
        );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }        
            return redirect()->to('/admin/inovasi/'. $data['inovasi_id'] . '/' . $menu)->with('success', 'Data inovasi berhasil diperbaharui!');
    }
    public function delete($id = null)
    {
        $existing = $this->inovasiModel->getInovasiDetail($id)[0];
        $inovasi_id = $existing['inovasi_id'];
        $menu = '';
        if ($inovasi_id == 1) {
            $menu = 'kolaborasi';            
        }elseif($inovasi_id == 2){
            $menu = 'kinerja';
        }elseif($inovasi_id == 3){
            $menu = 'kompetensi';
        }

        if (!$existing) {
            return redirect()->to('/admin/inovasi')->with('error', 'Data tidak ditemukan');
        }
            $oldImage = $existing['inovasi_list_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/inovasi/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/inovasi/' . $oldImage);
        }
        $this->inovasiModel->deleteInovasiList($id);
        return redirect()->to('/admin/inovasi/'. $inovasi_id . '/' . $menu)->with('success', 'Data inovasi berhasil dihapus');
    }
}