<?php

namespace App\Models;

// use CodeIgniter\Model;
use App\Models\BaseModel;

class penghargaanModel extends BaseModel
{
    protected $table = 'tb_penghargaan';
    protected $primaryKey = 'penghargaan_id'; 
    protected $allowedFields = ['penghargaan_id', 'penghargaan_img', 'created_at'];
}