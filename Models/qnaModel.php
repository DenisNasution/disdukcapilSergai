<?php

namespace App\Models;

use App\Models\BaseModel;

class qnaModel extends BaseModel
{
    protected $table = 'tb_qna';
    protected $primaryKey = 'qna_id';
    protected $allowedFields = [
        'qna_id',
        'qna_name',
        'qna_id_number',
        'qna_question',
        'qna_file',
        'qna_answer',
        'qna_status',
        'qna_reject_reason',
        'qna_answered_at'
    ];
    protected $useTimestamps = false;

    
    public function getAnswered()
    {
        return $this->where('qna_status', 'answered')
                    ->orderBy('qna_answered_at', 'DESC')
                    ->findAll();
    }

    public function getByStatus(string $status, int $perPage = 10, string $group = 'default')
    {
        return $this->where('qna_status', $status)
                    ->orderBy('qna_created_at', 'DESC')
                    ->paginate($perPage, $group);
    }

    // Admin: get counts for tabs
    public function getCounts()
    {
        return [
            'pending'  => $this->where('qna_status', 'pending')->countAllResults(),
            'answered' => $this->where('qna_status', 'answered')->countAllResults(),
            'rejected' => $this->where('qna_status', 'rejected')->countAllResults(),
        ];
    }
}