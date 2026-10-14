<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\faqModel;

class Faq extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new faqModel();
    }

        public function index()
    {
        $data['faq'] = $this->faqModel->orderBy('id', 'ASC')->findAll();
        $data['title'] = 'Kelola Data FAQ';
        
        return view('admin/faq/index', $data);
    }

    public function store()
    {
        $rules = [
            'faq_question'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Pertanyaan wajib diisi.',
                    'min_length' => 'Pertanyaan minimal {param} karakter.',
                ],
            ],
            'faq_answer'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Jawaban wajib diisi.',
                    'min_length' => 'Jawaban minimal {param} karakter.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'faq_id'        => $this->faqModel->generateId(),
            'faq_answer'      => $this->request->getPost('faq_answer'),
            'faq_question'  => $this->request->getPost('faq_question'),
        ];

        try {
        $this->faqModel->insert($data);

        $dbError = $this->faqModel->db->error();

        if ($dbError['code'] !== 0) {
            log_message('error', 'FAQ insert failed: ' . $dbError['message']);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $dbError['message']);
        }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }        
        return redirect()->to('/admin/faq')->with('success', 'Data FAQ berhasil ditambahkan!');       
    }

        public function create()
    {
        $data['title'] = 'Tambah Data FAQ';
        return view('admin/faq/create', $data);
    }

        public function edit($id = null)
    {
        $data['faq'] = $this->faqModel->find($id);
        
        if (!$data['faq']) {
            return redirect()->to('/admin/faq')->with('error', 'Data tidak ditemukan');
        }
        
        $data['title'] = 'Edit Data FAQ';
        return view('admin/faq/edit', $data);
    }
    public function update($id = null)
    {
        $existing = $this->faqModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/faq')->with('error', 'Data tidak ditemukan');
        }

            $rules = [
            'faq_question'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Pertanyaan wajib diisi.',
                    'min_length' => 'Pertanyaan minimal {param} karakter.',
                ],
            ],
            'faq_answer'  => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Jawaban wajib diisi.',
                    'min_length' => 'Jawaban minimal {param} karakter.',
                ],
            ],
            ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $result = $this->updateSimple(
            $this->faqModel, 
            $id, 
            [
                'faq_question' => $this->request->getPost('faq_question'),
                'faq_answer' => $this->request->getPost('faq_answer'),
            ]
        );
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        if (!$result['success']) {
        return redirect()->back()->withInput()->with('error', $result['error']);
        }        

        return redirect()->to('/admin/faq')->with('success', 'Data FAQ berhasil diperbarui!');
    }
        public function delete($id = null)
    {
        $existing = $this->faqModel->find($id);
        if (!$existing) {
            return redirect()->to('/admin/faq')->with('error', 'Data tidak ditemukan');
        }
        $this->faqModel->delete($id);
        return redirect()->to('/admin/faq')->with('success', 'Data FAQ berhasil dihapus');
    }
}