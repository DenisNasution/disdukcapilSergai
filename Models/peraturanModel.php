<?php

namespace App\Models;

use App\Models\BaseModel;

class peraturanModel extends BaseModel
{
    protected $table = 'tb_peruu'; 
    protected $primaryKey = 'perUU_id';
    protected $allowedFields = ['perUU_id','perUU_name', 'created_at'];

    
    public function getPerUU()
    {
        return $this->db->table('tb_peruu')
                        ->orderBy('id')
                        ->get()
                        ->getResultArray();
    }

     public function getPerUUWithPagination()
    {
           $this->table = 'tb_peruu';
        $this->primaryKey = 'perUU_id';
        $this->allowedFields = ['perUU_id', 'perUU_name', 'perUU_file'];
        
        return $this;
    }

    
    public function getSkPelayanan()
    {
        return $this->db->table('tb_sk_pelayanan')
                        ->orderBy('id')
                        ->get()
                        ->getResultArray();
    }

     public function getSkPelayananWithPagination()
    {
           $this->table = 'tb_sk_pelayanan';
        $this->primaryKey = 'sk_pelayanan_id';
        $this->allowedFields = ['sk_pelayanan_id', 'sk_pelayanan_name', 'sk_pelayanan_file'];
        
        return $this;
    }
}