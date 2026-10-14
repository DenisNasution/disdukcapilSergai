<?php

namespace App\Controllers;

use App\Models\qnaModel;

class Qna extends BaseController
{
    protected $qnaModel;

    public function __construct()
    {
        helper('text');
        $this->qnaModel = new qnaModel();
    }

    public function index()
    {
        $data['qna'] = $this->qnaModel->getAnswered();
        $data['title'] = 'Tanya Jawab - Disdukcapil Sergai';
        return view('qna', $data);
    }

    public function submit()
    {
        $rules = [
        'qna_name'      => 'required|min_length[3]|max_length[100]',
        'qna_id_number' => 'required|min_length[5]|max_length[50]|numeric',
        'qna_question'  => 'required|min_length[10]|max_length[1000]',
        'qna_file'   => [
                'rules' =>'max_size[qna_file,254]|ext_in[qna_file,pdf]', 'errors' => [
                    'max_size' => 'Ukuran file maximal 1 Mb',
                    'ext_in' => 'File harus berjenis pdf'
                ], 
            ]
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        'qna_id'        => $this->qnaModel->generateId(),
        'qna_name'      => $this->request->getPost('qna_name'),
        'qna_id_number' => $this->request->getPost('qna_id_number'),
        'qna_question'  => $this->request->getPost('qna_question'),
        'qna_status'    => 'pending',
    ];

    $file = $this->request->getFile('qna_file');
    $uploadedFileName = null;
    $uploadPath = WRITEPATH . '../public/uploads/qna';

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file->getTempName());

        if ($mimeType !== 'application/pdf') {
            return redirect()->back()->withInput()->with('error', 'File bukan PDF valid!');
        }

        $uploadedFileName = $file->getRandomName();

        try {
            $file->move($uploadPath, $uploadedFileName);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal upload: ' . $e->getMessage());
        }

        $data['qna_file'] = $uploadedFileName;
    }

    try {
        $this->qnaModel->insert($data);

        $dbError = $this->qnaModel->db->error();

        if ($dbError['code'] !== 0) {
            if ($uploadedFileName && file_exists($uploadPath . '/' . $uploadedFileName)) {
                unlink($uploadPath . '/' . $uploadedFileName);
            }
            log_message('error', 'QnA insert failed: ' . $dbError['message']);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $dbError['message']);
        }
    } catch (\Exception $e) {
        if ($uploadedFileName && file_exists($uploadPath . '/' . $uploadedFileName)) {
            unlink($uploadPath . '/' . $uploadedFileName);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
    }


        return redirect()->to('/tanya-jawab')->with('success', 'Pertanyaan Anda berhasil dikirim. Silakan tunggu jawaban dari petugas kami.');
    }
}

