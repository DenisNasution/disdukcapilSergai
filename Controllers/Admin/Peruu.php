<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\peraturanModel;

class Peruu extends BaseController
{
    protected $peraturanModel;

    public function __construct()
    {
        $this->peraturanModel = new peraturanModel();
    }

    public function index()
    {
        $data['peraturan'] = $this->peraturanModel->getPerUUWithPagination()->orderBy('id')->paginate(10, 'default');
        $data['pager'] = $this->peraturanModel->pager;
        $data['title'] = 'Kelola Peraturan Undang-undang';
        return view('admin/peruu/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Peraturan';
        return view('admin/peruu/create', $data);
    }

    public function store()
    {
        $rules = [
            'perUU_name'  => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama Perundang - undangan wajib diisi.',
                    'min_length' => 'Nama Perundang - undangan minimal {param} karakter.',
                ],
            ],
            'perUU_file'   => [
                'rules' =>'uploaded[perUU_file]|max_size[perUU_file,1024]|ext_in[perUU_file,pdf]', 'errors' => [
                    'uploaded'   => 'File Harus Diisi.',
                    'max_size' => 'Ukuran file maximal 1 Mb',
                    'ext_in' => 'File harus berjenis pdf'
                ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('perUU_file');

        if ($file->isValid() && !$file->hasMoved()) {
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file->getTempName());
            
            if ($mimeType !== 'application/pdf') {
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan PDF yang valid!');
            }

            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/images/peraturan/PerUU', $newName);

            $this->peraturanModel->getPerUUWithPagination()->insert([
                'perUU_id'   => $this->peraturanModel->generateId(),
                'perUU_name'    => $this->request->getPost('perUU_name'),
                'perUU_file'     => $newName
            ]);

            return redirect()->to('/admin/peruu')->with('success', 'Peraturan berhasil ditambahkan!');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengupload file.');
    }

    public function edit($id = null)
    {
        $data['peraturan'] = $this->peraturanModel->getPerUUWithPagination()->find($id);
        if (!$data['peraturan']) {
            return redirect()->to('/admin/peruu')->with('error', 'Data tidak ditemukan');
        }
        $data['currentPage'] = $this->request->getVar('page') ?? 1;
        $data['title'] = 'Edit Perundang-undangan';
        return view('admin/peruu/edit', $data);
    }

    public function update($id = null)
    {
        $existing = $this->peraturanModel->getPerUUWithPagination()->find($id);
        $rules = [
            'perUU_name'  => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama Perundang - undangan wajib diisi.',
                    'min_length' => 'Nama Perundang - undangan minimal {param} karakter.',
                ],
            ],
            'perUU_file'   => [
                'rules' =>'max_size[perUU_file,1024]|ext_in[perUU_file,pdf]', 'errors' => [
                    'max_size' => 'Ukuran file maximal 1 Mb',
                    'ext_in' => 'File harus berjenis pdf'
                ], 
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'perUU_name'  => $this->request->getPost('perUU_name'),
        ];

        $file = $this->request->getFile('perUU_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file->getTempName());
            
            if ($mimeType !== 'application/pdf') {
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan PDF yang valid!');
            }
        try{
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/images/peraturan/PerUU', $newName);
            
            if ($existing['perUU_file'] && file_exists(WRITEPATH . '../public/uploads/images/peraturan/PerUU/' . $existing['perUU_file'])) {
                unlink(WRITEPATH . '../public/uploads/images/peraturan/PerUU/' . $existing['perUU_file']);
            }            
            
            $data['perUU_file'] = $newName;
            }
            catch(\Exception $e){
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload File: ' . $e->getMessage());
            }
        }
        else{
            $data['perUU_file'] = $existing['perUU_file'];
        }

        $this->peraturanModel->update($id, $data);
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/peruu?page=' . $page)->with('success', 'Perundang-undangan berhasil diperbarui!');
    }
    public function delete($id = null)
    {
        $item = $this->peraturanModel->getPerUUWithPagination()->find($id);
        $oldImage = $item['perUU_file'];
        if ($oldImage && file_exists(WRITEPATH . '../public/uploads/images/peraturan/PerUU/' . $oldImage)) {
            unlink(WRITEPATH . '../public/uploads/images/peraturan/PerUU/' . $oldImage);
        }

        $this->peraturanModel->getPerUUWithPagination()->delete($id);
        $page = $this->request->getVar('page') ?? 1;
        return redirect()->to('/admin/peruu?page=' . $page)->with('success', 'File Perundang-undangan berhasil dihapus!');
    }
}