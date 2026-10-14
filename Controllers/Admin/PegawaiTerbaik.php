<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\kepegawaianModel;

class PegawaiTerbaik extends BaseController
{
    protected $kepegawaianModel;

    public function __construct()
    {
        $this->kepegawaianModel = new kepegawaianModel();
    }

    public function index()
    {
        $data['pegterbaik'] = $this->kepegawaianModel->getPegawaiTerbaik();
        $data['title'] = 'Kelola Data Pegawai Terbaik' ;
        return view('admin/pegterbaik/index', $data);
    }
     public function create()
    {
        $data['title'] = 'Tambah Data Pegawai Terbaik';
        return view('admin/pegterbaik/create', $data);
    }
    public function store()
    {
            $rules = [
            'pegawai_terbaik_name'  => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama Pegawai wajib diisi.',
                    'min_length' => 'Nama Pegawai minimal {param} karakter.',
                ],
            ],
            'pegawai_terbaik_date'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Bulan wajib diisi.',
                    'min_length' => 'Bulan minimal {param} karakter.',
                ],
            ],
            'pegawai_terbaik_img'   => [
                    'rules' =>'uploaded[pegawai_terbaik_img]|is_image[pegawai_terbaik_img]|max_size[pegawai_terbaik_img,512]', 'errors' => [
                        'uploaded'   => 'Gambar Harus Diisi.',
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('pegawai_terbaik_img');
        if ($file->isValid() && !$file->hasMoved()) {

            $result = $this->saveWithImage(
                $this->kepegawaianModel,
                [
                    'pegawai_terbaik_id'   => $this->kepegawaianModel->generateId(),
                    'pegawai_terbaik_name' => $this->request->getPost('pegawai_terbaik_name'),
                    'pegawai_terbaik_date'  => $this->request->getPost('pegawai_terbaik_date'),
                ],
                $file,
                WRITEPATH . '../public/uploads/images/pegawai/terbaik',
                'pegawai_terbaik_img',
                function($model, $data) {
                    return $model->savePegawaiTerbaik($data);
                }
            );

            if (!$result['success']) {
                return redirect()->back()->withInput()->with('error', $result['error']);
            }

            return redirect()->to('/admin/pegterbaik')->with('success', 'Data Pegawai Terbaik berhasil ditambahkan!');
        }

    }
   
    public function edit($id = null)
    {
            $data['pegterbaik'] = $this->kepegawaianModel->getPegawaiTerbaikDetail($id);
        
        if (!$data['pegterbaik']) {
            return redirect()->to('/admin/pegterbaik')->with('error', 'Data tidak ditemukan');
        }
        $data['title'] = 'Edit Data Pegawai Terbaik';
        return view('admin/pegterbaik/edit', $data);
    }
    public function update($id = null)
    {
        $rules = [
        'pegawai_terbaik_name'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Nama Pegawai wajib diisi.',
                    'min_length' => 'Nama Pegawai minimal {param} karakter.',
                ],
            ],
            'pegawai_terbaik_date'  => [
                'rules'  => 'required|min_length[2]',
                'errors' => [
                    'required'   => 'Bulan wajib diisi.',
                    'min_length' => 'Bulan minimal {param} karakter.',
                ],
            ],
            'pegawai_terbaik_img'   => [
                    'rules' =>'is_image[pegawai_terbaik_img]|max_size[pegawai_terbaik_img,512]', 'errors' => [
                        'max_size' => 'Ukuran file maximal 500 Kb',
                        'is_image' => 'File harus berjenis gambar'
                    ], 
            ]        
        ];
        $existing = $this->kepegawaianModel->getPegawaiTerbaikDetail($id)[0];

        if (!$existing) {
            return redirect()->to('/admin/pegterbaik')->with('error', 'Data tidak ditemukan');
        }
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'pegawai_terbaik_name' => $this->request->getPost('pegawai_terbaik_name'),
            'pegawai_terbaik_date'  => $this->request->getPost('pegawai_terbaik_date'),
        ];

        $file = $this->request->getFile('pegawai_terbaik_img');
        $result = $this->updateWithImage(
            $this->kepegawaianModel,
            $id,
            $data,
            $file,
            WRITEPATH . '../public/uploads/images/pegawai/terbaik',
            'pegawai_terbaik_img',
            $existing['pegawai_terbaik_img'],
            function($model, $id, $data) {
                return $model->updatePegawaiTerbaik($id, $data);
            }
        );
        if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/admin/pegterbaik')->with('success', 'Data Pegawai Terbaik berhasil diperbaharui!');
    }
    public function delete($id = null)
    {
        $existing = $this->kepegawaianModel->getPegawaiTerbaikDetail($id)[0];
        if (!$existing) {
            return redirect()->to('/admin/pegterbaik')->with('error', 'Data tidak ditemukan');
        }
        $oldImage = $existing['pegawai_terbaik_img'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/pegawai/terbaik/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/pegawai/terbaik/' . $oldImage);
        }
        $this->kepegawaianModel->deletePegawaiTerbaik($id);
        return redirect()->to('/admin/pegterbaik')->with('success', 'Data Pegawai Terbaik berhasil dihapus');
    }
}