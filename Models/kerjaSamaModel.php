<?php

namespace App\Models;

use App\Models\BaseModel;

class kerjaSamaModel extends BaseModel
{
     protected $table = 'tb_kerjaSama';
    protected $primaryKey = 'kerjaSama_id'; 
    protected $allowedFields = ['kerjaSama_id', 'kerjaSama_img', 'created_at', 'id'];
}