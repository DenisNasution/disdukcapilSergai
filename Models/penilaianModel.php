<?php

namespace App\Models;

use App\Models\BaseModel;

class penilaianModel extends BaseModel
{
    protected $table = 'tb_penilaian';
    protected $primaryKey = 'penilaian_id'; 
    protected $allowedFields = ['penilaian_id, penilaian_name', 'created_at'];

    public function getPenilaianWithList($id)
    {    
        $item = $this->find($id);    
        if ($item) {
            $item['list_items'] = $this->db->table('tb_penilaian_list')
            ->where('penilaian_id', $id)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();
        }

        return $item; 
    }
    public function getPenilaianDetail($id)
{   
        $item = $this->db->table('tb_penilaian_list')
        ->where('penilaian_list_id', $id)
        ->get()
        ->getResultArray();
    return $item; 
}
    public function savePenilaianList($data)
    {   
        $item = $this->db->table('tb_penilaian_list')
        ->insert($data);
        return $item; 
    }
    public function updatePenilaianList($id, $data)
    {
        return $this->db->table('tb_penilaian_list')
                        ->where('penilaian_list_id', $id)
                        ->update($data);
    }
    public function deletePenilaianList($id)
    {
        return $this->db->table('tb_penilaian_list')
                        ->where('penilaian_list_id', $id)
                        ->delete();
    }
}