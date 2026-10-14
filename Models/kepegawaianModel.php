<?php

namespace App\Models;

use App\Models\BaseModel;

class kepegawaianModel extends BaseModel
{
    protected $table = 'tb_struktur'; 
    protected $primaryKey = 'struktur_id';
    protected $allowedFields = ['struktur_id','struktur_img', 'created_at'];

    
    public function getStruktur()
    {
        return $this->db->table('tb_struktur')
                        ->get()
                        ->getResultArray();
    }
    public function getStrukturDetail($id)
    {   
        return $this->db->table('tb_struktur')
                        ->where('struktur_id', $id)
                        ->get()
                        ->getResultArray();        
    }
    public function updateStruktur($id,$data)    
    {   
        return $this->db->table('tb_struktur')
                        ->where('struktur_id', $id)
                        ->update($data);       
    }
    public function getPegawaiTerbaik()
    {
        return $this->db->table('tb_pegawai_terbaik')
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->getResultArray();
    }
    public function getPegawaiTerbaikDetail($id)
    {   
        return $this->db->table('tb_pegawai_terbaik')
                        ->where('pegawai_terbaik_id', $id)
                        ->get()
                        ->getResultArray();
    }
    public function savePegawaiTerbaik($data)
    {   
        return $this->db->table('tb_pegawai_terbaik')
                        ->insert($data); 
    }
        public function updatePegawaiTerbaik($id, $data)
    {   
        return $this->db->table('tb_pegawai_terbaik')
                            ->where('pegawai_terbaik_id',$id)
                            ->update($data);
        
    }
    public function deletePegawaiTerbaik($id)
    {
        return $this->db->table('tb_pegawai_terbaik')
                        ->where('pegawai_terbaik_id', $id)
                        ->delete();
    }
    
    public function getDataPegawai()
    {
        return $this->db->table('tb_data_pegawai')
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->getResultArray();
    }
    public function getDataPegawaiDetail($id)
    {   
        return $this->db->table('tb_data_pegawai')
                        ->where('data_pegawai_id', $id)
                        ->get()
                        ->getResultArray();
    }
    public function updateDataPegawai($id, $data)
    {   
        return $this->db->table('tb_data_pegawai')
                        ->where('data_pegawai_id',$id)
                        ->update($data); 
    }
}