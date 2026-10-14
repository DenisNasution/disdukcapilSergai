<?php

namespace App\Models;

use App\Models\BaseModel;

class pendudukModel extends BaseModel
{
    protected $table = ' tb_data_penduduk'; 
    protected $primaryKey = 'data_penduduk_id';
    protected $allowedFields = ['data_penduduk_id','data_penduduk_name', 'data_penduduk_jenis', 'data_penduduk_jmlh', 'created_at'];
    
    public function getJkel()
     
    {
          return $this->where('data_penduduk_jenis', 1)->findAll();
    }
    
    public function getKKel()
     
    {
          return $this->where('data_penduduk_jenis', 2)->findAll();
    }
    public function getAgama()
     
    {
          return $this->where('data_penduduk_jenis', 3)->findAll();
    }
    public function getPendidikan()
     
    {
          return $this->where('data_penduduk_jenis', 4)->findAll();
    }
}