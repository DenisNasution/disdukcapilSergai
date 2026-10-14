<?php

namespace App\Models;

use App\Models\BaseModel;

class persyaratanModel extends BaseModel
{
    protected $table = 'tb_persyaratan';
    protected $primaryKey = 'persyaratan_id'; 
    protected $allowedFields = ['persyaratan_id', 'persyaratan_img', 'persyaratan_name', 'created_at'];
}

