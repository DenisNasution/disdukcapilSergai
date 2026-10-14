<?php

namespace App\Models;

use App\Models\BaseModel;

class profileModel extends BaseModel
{
    protected $table = 'tb_visimisi';
    protected $primaryKey = 'visimisi_id'; 
    protected $allowedFields = ['visimisi_id', 'visimisi_name','visimisi_desc', 'visimisi_kat_id', 'created_at'];
    
}