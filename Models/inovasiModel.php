<?php

namespace App\Models;

use App\Models\BaseModel;

class inovasiModel extends BaseModel
{
     protected $table = 'tb_inovasi';
    protected $primaryKey = 'inovasi_id'; 
    protected $allowedFields = ['inovasi_id', 'inovasi_name', 'created_at'];
     public function getInovasiWithImages()
    {
            $inovasi = $this->findAll();
        
            foreach ($inovasi as &$item) {
            $item['list_items'] = $this->db->table('tb_inovasi_list')
                                ->where('inovasi_id', $item['inovasi_id'])
                                ->orderBy('id')
                                ->get()
                                ->getResultArray();
        }

        return $inovasi;
    }
      public function getInovasiWithList($id)
{
    $item = $this->find($id);

    if ($item) {
        $item['list_items'] = $this->db->table('tb_inovasi_list')
        ->where('inovasi_id', $id)
        ->orderBy('id')
        ->get()
        ->getResultArray();
    }

        return $item; }
    public function getInovasiDetail($id)
    {   
            $item = $this->db->table('tb_inovasi_list')
            ->where('inovasi_list_id', $id)
            ->get()
            ->getResultArray();
        return $item; }
        public function saveinovasiList($data)
    {   
            $item = $this->db->table('tb_inovasi_list')
            ->insert($data);
        return $item; }
    public function updateInovasiList($id, $data)
        {
            return $this->db->table('tb_inovasi_list')
                            ->where('inovasi_list_id', $id)
                            ->update($data);
        }
        public function deleteInovasiList($id)
        {
            return $this->db->table('tb_inovasi_list')
                            ->where('inovasi_list_id', $id)
                            ->delete();
        }
}