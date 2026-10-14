<?php

namespace App\Models;

use App\Models\BaseModel;

class berandaModel extends BaseModel
{
     protected $table = 'tb_beranda';
    protected $primaryKey = 'beranda_id'; 
    protected $allowedFields = ['beranda_id', 'beranda_img','beranda_desc', 'beranda_date','beranda_kat_id', 'created_at'];
  
}