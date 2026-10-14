<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\penilaianModel;

class Penilaian extends BaseController
{
    protected $penilaianModel;

    public function __construct()
    {
        $this->penilaianModel = new penilaianModel();
    }

        public function index($id = null, $menu = 'kemendagri')
    {   $allowed = ['kemendagri', 'kemenpanrb', 'ombudsman','itkab'];
         if (!in_array($menu, $allowed)) {
            $menu = 'kemendagri';
        }
        $data['activeStatus'] = $menu;
        $data['main_name'] = $this->penilaianModel->find($id);
        $data['penilaian_id'] = $id;

        $data['main_item'] = $this->penilaianModel->getPenilaianWithList($id);
        $data['title'] = 'Kelola Data Penilaian' . " " .$data['main_name']['penilaian_name'] ;
        return view('admin/penilaian/index', $data);
    }

     public function store()
    {
        $rules = [
            'penilaian_id'  => 'required|numeric|max_length[4]',
            'penilaian_list_img'   => [
                    'rules' =>'uploaded[penilaian_list_img]|is_image[penilaian_list_img]|max_size[penilaian_list_img,512]', 'errors' => [
                        'uploaded'   => 'Gambar Harus Diisi.',
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];
        $menu = '';
        if ($this->request->getPost('penilaian_id') == 1) {
            $menu = 'kemendagri';
            
        }elseif($this->request->getPost('penilaian_id') == 2){
            $menu = 'kemenpanrb';
        }elseif($this->request->getPost('penilaian_id') == 3){
            $menu = 'ombudsman';
        }
        elseif($this->request->getPost('penilaian_id') == 4){
            $menu = 'itkab';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('penilaian_list_img');

        if ($file->isValid() && !$file->hasMoved()) {
            $result = $this->saveWithImage(
            $this->penilaianModel,
            [
                'penilaian_list_id'   => $this->penilaianModel->generateId(),
                'penilaian_id' => $this->request->getPost('penilaian_id'),
            ],
            $file,
            WRITEPATH . '../public/uploads/images/nilai',
            'penilaian_list_img',
            function($model, $data) {
                return $model->savePenilaianList($data);
            }

        );

        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }
        return redirect()->to('/admin/penilaian/' . $this->request->getPost('penilaian_id') . '/' . $menu )->with('success', 'Data Penilaian berhasil ditambahkan!');
        }

    }

    public function create($id = null)
    {
        $data['penilaian'] = $this->penilaianModel->findAll();
        $data['penilaian_id'] = $id;
        $data['title'] = 'Tambah Data Penilaian';
        return view('admin/penilaian/create', $data);
    }

        public function edit($id = null)
    {
        $data['penilaian'] = $this->penilaianModel->findAll();
        $data['penilaian_detail'] = $this->penilaianModel->getPenilaianDetail($id)[0];
        
        if (!$data['penilaian_detail']) {
            return redirect()->to('/admin/penilaian')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data Penilaian';
    
        return view('admin/penilaian/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->penilaianModel->getPenilaianDetail($id)[0];
        if (!$existing) {
            return redirect()->to('/admin/penilaian/1')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'penilaian_id'  => 'required|numeric|max_length[4]',
            'penilaian_list_img'   => [
                'rules' =>'is_image[penilaian_list_img]|max_size[penilaian_list_img,512]', 'errors' => [
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]         
        ];
        $menu = '';
        if ($this->request->getPost('penilaian_id') == 1) {
            $menu = 'kemendagri';
            
        }elseif($this->request->getPost('penilaian_id') == 2){
            $menu = 'kemenpanrb';
        }elseif($this->request->getPost('penilaian_id') == 3){
            $menu = 'ombudsman';
        }
        elseif($this->request->getPost('penilaian_id') == 4){
            $menu = 'itkab';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'penilaian_id' => $this->request->getPost('penilaian_id'),
        ];

        $file = $this->request->getFile('penilaian_list_img');
            $result = $this->updateWithImage(
                $this->penilaianModel,
                $id,
                $data,
                $file,
                WRITEPATH . '../public/uploads/images/nilai',
                'penilaian_list_img',
                $existing['penilaian_list_img'],
                function($model, $id, $data) {
                    return $model->updatePenilaianList($id, $data);
                }
            );
            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }
            
            return redirect()->to('/admin/penilaian/'. $data['penilaian_id'] . '/' . $menu)->with('success', 'Data Penilaian berhasil diperbaharui!');
        
    }
    public function delete($id = null)
    {
        $existing = $this->penilaianModel->getPenilaianDetail($id)[0];
        $penilaian_id = $existing['penilaian_id'];
            $menu = '';
        if ($penilaian_id == 1) {
            $menu = 'kemendagri';
            
        }elseif($penilaian_id == 2){
            $menu = 'kemenpanrb';
        }elseif($penilaian_id == 3){
            $menu = 'ombudsman';
        }
        elseif($penilaian_id == 4){
            $menu = 'itkab';
        }
        if (!$existing) {
            return redirect()->to('/admin/penilaian')->with('error', 'Data tidak ditemukan');
        }
                $oldImage = $existing['penilaian_list_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/nilai/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/nilai/' . $oldImage);
        }
        $this->penilaianModel->deletePenilaianList($id);
        return redirect()->to('/admin/penilaian/'. $penilaian_id . '/' . $menu)->with('success', 'Data Penilaian berhasil dihapus');
    }
}