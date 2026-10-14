<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\kepegawaianModel;

class Struktur extends BaseController
{
    protected $kepegawaianModel;

    public function __construct()
    {
        $this->kepegawaianModel = new kepegawaianModel();
    }

        public function index()
    {
        $data['struktur'] = $this->kepegawaianModel->getStruktur();
        $data['title'] = 'Kelola Data Struktur Organisasi' ;
        return view('admin/struktur/index', $data);
    }
   
        public function edit($id = null)
    {
                $data['struktur'] = $this->kepegawaianModel->getStrukturDetail($id);
        
        if (!$data['struktur']) {
            return redirect()->to('/admin/struktur')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Struktur Organisasi';
                return view('admin/struktur/edit', $data);
    }
          public function update($id = null)
    {
        $existing = $this->kepegawaianModel->getStrukturDetail($id)[0];
        

        $rules = [
            'struktur_img'   => [
                'rules' =>'uploaded[struktur_img]|is_image[struktur_img]|max_size[struktur_img,512]', 'errors' => [
                    'uploaded'   => 'Gambar Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 500 Kb',
                    'is_image' => 'File harus berjenis gambar'
                ], 
            ]
          
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('struktur_img');
        $data['struktur_img'] = "";
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $result = $this->updateWithImage(
                $this->kepegawaianModel,
                $id,
                [],
                $file,
                WRITEPATH . '../public/uploads/images/pegawai',
                'struktur_img',
                $existing['struktur_img'],
                function($model, $id, $data) {
                return $model->updateStruktur($id, $data);
            }
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }       

            return redirect()->to('/admin/struktur')->with('success', 'Data Struktur Organisasi berhasil diperbarui!');
        }
    }
}