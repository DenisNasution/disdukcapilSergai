<?php

namespace App\Controllers;
use App\Models\persyaratanModel;

class Persyaratan extends BaseController
{    
    public function persyaratan()
    {
        $newsModel = new persyaratanModel();
        $data['persyaratan'] = $newsModel->orderBy('id')->findAll(); 
        $data['title'] = 'Persyaratan - Disdukcapil Sergai';
        return view('persyaratan', $data);
    }   

   
    
}
