<?php

namespace App\Models;

use App\Models\BaseModel;

class faqModel extends BaseModel
{
    protected $table = 'tb_faq';
    protected $primaryKey = 'faq_id'; 
    protected $allowedFields = ['faq_id', 'id_faq','faq_question', 'faq_answer'];
    
}