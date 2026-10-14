<?php

namespace App\Models;

use App\Models\BaseModel;

class jadiTauModel extends BaseModel
{
    protected $table = 'tb_jaditau';
    protected $primaryKey = 'jadiTau_id'; 
    protected $allowedFields = ['jadiTau_id', 'jadiTau_img', 'jadiTau_name', 'jadiTau_desc', 'created_at'];
}