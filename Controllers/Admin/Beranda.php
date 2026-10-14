<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\berandaModel;

class Beranda extends BaseController
{
    protected $berandaModel;

    public function __construct()
    {
        $this->berandaModel = new berandaModel();
    }

    public function index($id = null, $menu = 'slider')
    {
        $allowed = ['slider', 'gallery'];
        if (!in_array($menu, $allowed)) {
            $menu = 'slider';
        }
        $data['activeStatus'] = $menu;
        $data['beranda'] = $this->berandaModel->select()->where('beranda_kat_id', $id)->orderBy('id')->findAll();
        if ($id == 1) {
            $data['title'] = 'Kelola Slider';
            $data['folder'] = 'carrousel';
            $data['kat_id'] = 1;
            
        }else{
            $data['title'] = 'Kelola Gallery';               
            $data['folder'] = 'galeri';
            $data['kat_id'] = 2;
        }
        
        return view('admin/beranda/index', $data);
    }
    public function edit($id = null)
    {
        $data['beranda'] = $this->berandaModel->find($id);
        
        if (!$data['beranda']) {
            return redirect()->to('/admin/beranda/'.$data['beranda']['beranda_kat_id'])->with('error', 'Data tidak ditemukan');
        }

        if ($data['beranda']['beranda_kat_id'] == 1) {
            $data['title'] = 'Edit Data Slider';
            $data['folder'] = 'carrousel';
            $data['kat_id'] = 1;
            
        }else{
            $data['title'] = 'Edit Data Gallery';               
            $data['folder'] = 'galeri';
            $data['kat_id'] = 2;
        }
        
        $data['title'] = 'Edit Data Slider';
        return view('admin/beranda/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->berandaModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/beranda/'.$existing['beranda_kat_id'])->with('error', 'Data tidak ditemukan');
        }
        $rules = [];
        $data = [];
        $folder = '';
        $menu = '';

        if ($existing['beranda_kat_id']  == 1) {
            $rules = [       
                'beranda_img'   => [
                    'rules' =>'uploaded[beranda_img]|is_image[beranda_img]|max_size[beranda_img,512]', 'errors' => [
                        'uploaded'   => 'Kalau Ingin Ganti gambar wajib pilih file.',
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
                ]
            ];
            $folder = 'carrousel';
            $menu = 'slider';
        }else{
            $rules = [       
            'beranda_desc'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Judul wajib diisi.',
                    'min_length' => 'Judul minimal {param} karakter.',
                ],
            ],
            'beranda_date'  =>  [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required'   => 'Tanggal wajib diisi.',
                    'min_length' => 'Tanggal minimal {param} karakter.',
                ],
            ],
            'beranda_img'   => ['rules' =>'is_image[beranda_img]|max_size[beranda_img,512]', 'errors' => [
            'max_size' => 'Ukuran Gambar maximal 500 Kb',
            'is_image' => 'File harus berjenis gambar'
        ], ]
            ];
            $folder = 'galeri';
            $menu = 'gallery';
            $data = [
            'beranda_desc' => $this->request->getPost('beranda_desc'),
            'beranda_date' => $this->request->getPost('beranda_date'),
            ];
        }

        

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('beranda_img');
        // dd($file->getError());
        $result = $this->updateWithImage(
        $this->berandaModel,
        $id,
        $data,
        $file,
        WRITEPATH . '../public/uploads/images/beranda/'.$folder,
        'beranda_img',
        $existing['beranda_img']
    );

    if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
    }
    return redirect()->to('/admin/beranda/'.$existing['beranda_kat_id'].'/'.$menu)->with('success', 'Data Berhasil diperbaharui!');
    }
}