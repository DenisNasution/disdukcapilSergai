<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\qnaModel;

class Qna extends BaseController
{
    protected $qnaModel;

    public function __construct()
    {
        helper('text');
        $this->qnaModel = new qnaModel();
    }

    public function index($status = 'pending')
    {
        $allowed = ['pending', 'answered', 'rejected'];
        if (!in_array($status, $allowed)) {
            $status = 'pending';
        }
        $perPage = $this->request->getVar('perPage') ?? 10;
        $data['qna'] = $this->qnaModel->getByStatus($status);
        $data['pager'] = $this->qnaModel->pager;
        $data['counts'] = $this->qnaModel->getCounts();
        $data['activeStatus'] = $status;
        $data['title'] = 'Kelola Tanya Jawab';
        return view('admin/qna/index', $data);
    }

    public function detail($id = null)
    {
        $data['qna'] = $this->qnaModel->find($id);
        if (!$data['qna']) {
            return redirect()->to('/admin/qna')->with('error', 'Pertanyaan tidak ditemukan.');
        }
        $data['title'] = 'Respons Pertanyaan';
        return view('admin/qna/detail', $data);
    }

    public function submitAnswer($id = null)
    {
        $rules = [
            'qna_answer'  => [
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required'   => 'Jawaban/Alasan wajib diisi.',
                    'min_length' => 'Jawaban/Alasan minimal {param} karakter.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->qnaModel->update($id, [
            'qna_answer'      => $this->request->getPost('qna_answer'),
            'qna_status'      => 'answered',
            'qna_answered_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/qna/answered')->with('success', 'Jawaban berhasil disimpan!');
    }

    public function reject($id = null)
    {
        $reason = $this->request->getPost('qna_reject_reason') ?? 'Pertanyaan tidak sesuai.';

        $this->qnaModel->update($id, [
            'qna_status'        => 'rejected',
            'qna_reject_reason' => $reason
        ]);

        return redirect()->to('/admin/qna/rejected')->with('success', 'Pertanyaan ditolak.');
    }

    public function viewAnswer($id = null)
    {
        $data['qna'] = $this->qnaModel->find($id);
        if (!$data['qna']) {
            return redirect()->to('/admin/qna')->with('error', 'Pertanyaan tidak ditemukan.');
        }
        $data['title'] = 'Detail Jawaban';
        return view('admin/qna/view_answer', $data);
    }

    public function viewReject($id = null)
    {
        $data['qna'] = $this->qnaModel->find($id);
        if (!$data['qna']) {
            return redirect()->to('/admin/qna')->with('error', 'Pertanyaan tidak ditemukan.');
        }
        $data['title'] = 'Detail Penolakan';
        return view('admin/qna/view_reject', $data);
    }

    public function delete($id = null)
    {
         if (!is_superadmin()) {
        return redirect()->back()->with('error', 'Maaf anda tidak dapat menghapus data.');
    }
        $item = $this->qnaModel->find($id);
    
        if (!$item) {
            return redirect()->to('/admin/qna')->with('error', 'Pertanyaan tidak ditemukan.');
        }

        if (!empty($item['qna_file'])) {
            $filePath = WRITEPATH . '../public/uploads/qna/' . $item['qna_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $this->qnaModel->delete($id);
        return redirect()->to('/admin/qna')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}

