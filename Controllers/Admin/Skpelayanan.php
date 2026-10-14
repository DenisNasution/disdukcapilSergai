<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\peraturanModel;

class Skpelayanan extends BaseController
{
    protected $peraturanModel;

    public function __construct()
    {
        $this->peraturanModel = new peraturanModel();
    }

    public function index()
    {
        $data['peraturan'] = $this->peraturanModel->getSkPelayananWithPagination()->orderBy('id')->paginate(10, 'default');
        $data['pager'] = $this->peraturanModel->pager;
        $data['title'] = 'Kelola Sk Pelayanan';
        return view('admin/skpelayanan/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Sk Pelayanan';
        return view('admin/skpelayanan/create', $data);
    }

    public function store()
    {
        $rules = [
            'sk_pelayanan_name'  => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'SK Pelayanan wajib diisi.',
                    'min_length' => 'Pelayanan minimal {param} karakter.',
                ],
            ],
            'sk_pelayanan_file'   => [
                'rules' =>'uploaded[sk_pelayanan_file]|max_size[sk_pelayanan_file,1024]|ext_in[sk_pelayanan_file,pdf]', 'errors' => [
                    'uploaded'   => 'File Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 1 Mb',
                    'ext_in' => 'File harus berjenis pdf'
                ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('sk_pelayanan_file');

        if ($file->isValid() && !$file->hasMoved()) {
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file->getTempName());
            
            if ($mimeType !== 'application/pdf') {
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan PDF yang valid!');
            }

            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan', $newName);

            $this->peraturanModel->getSkPelayananWithPagination()->insert([
                'sk_pelayanan_id'   => $this->peraturanModel->generateId(),
                'sk_pelayanan_name'    => $this->request->getPost('sk_pelayanan_name'),
                'sk_pelayanan_file'     => $newName
            ]);

            return redirect()->to('/admin/skpelayanan')->with('success', 'SK berhasil ditambahkan!');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengupload file.');
    }

    public function edit($id = null)
    {
        $data['peraturan'] = $this->peraturanModel->getSkPelayananWithPagination()->find($id);
        if (!$data['peraturan']) {
            return redirect()->to('/admin/skpelayanan')->with('error', 'Data tidak ditemukan');
        }
        $data['currentPage'] = $this->request->getVar('page') ?? 1;
        $data['title'] = 'Edit SK Pelayanan';
        return view('admin/skpelayanan/edit', $data);
    }

    public function update($id = null)
    {
        $existing = $this->peraturanModel->getSkPelayananWithPagination()->find($id);
        $rules = [
            'sk_pelayanan_name'  => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'SK Pelayanan wajib diisi.',
                    'min_length' => 'SK Pelayanan minimal {param} karakter.',
                ],
            ],
            'sk_pelayanan_file'   => [
                'rules' =>'max_size[sk_pelayanan_file,1024]|ext_in[sk_pelayanan_file,pdf]', 'errors' => [
                    'max_size' => 'Ukuran file maximal 1 Mb',
                    'ext_in' => 'File harus berjenis pdf'
                ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'sk_pelayanan_name'    => $this->request->getPost('sk_pelayanan_name'),
        ];

        $file = $this->request->getFile('sk_pelayanan_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file->getTempName());
            
            if ($mimeType !== 'application/pdf') {
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan PDF yang valid!');
            }
        try{
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan', $newName);
            
            if ($existing['sk_pelayanan_file'] && file_exists(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan/' . $existing['sk_pelayanan_file'])) {
                unlink(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan/' . $existing['sk_pelayanan_file']);
            }
            
            $data['sk_pelayanan_file'] = $newName;
            }
        catch(\Exception $e){
            return redirect()->back()->withInput()->with('error', 'Gagal mengupload File: ' . $e->getMessage());
        }
        }
        else{
            $data['sk_pelayanan_file'] = $existing['sk_pelayanan_file'];
        }

        $this->peraturanModel->update($id, $data);
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/skpelayanan?page=' . $page)->with('success', 'SK berhasil diperbarui!');
    }

    public function delete($id = null)
    {
        $item = $this->peraturanModel->getSkPelayananWithPagination()->find($id);
        $oldImage = $item['sk_pelayanan_file'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/peraturan/SKPelayanan/' . $oldImage);
        }

        $this->peraturanModel->getSkPelayananWithPagination()->delete($id);
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/skpelayanan?page=' . $page)->with('success', 'SK berhasil dihapus!');
    }
}