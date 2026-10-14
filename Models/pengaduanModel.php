<?php

namespace App\Models;

use App\Models\BaseModel;

class pengaduanModel extends BaseModel
{
    protected $table = 'tb_pengaduan1';
    protected $primaryKey = 'pengaduan_id';
    protected $allowedFields = ['pengaduan_id','pengaduan_title', 'pengaduan_name','pengaduan_desc', 'pengaduan_img','pengaduan_slug','pengaduan_id', 'created_at'];
}