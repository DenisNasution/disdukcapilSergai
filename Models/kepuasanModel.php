<?php

namespace App\Models;

use App\Models\BaseModel;

class kepuasanModel extends BaseModel
{
     protected $table = 'tb_kepuasan';
    protected $primaryKey = 'kepuasan_id'; 
    protected $allowedFields = ['kepuasan_id','kepuasan_desc', 'kepuasan_score', 'kepuasan_img', 'created_at'];
}