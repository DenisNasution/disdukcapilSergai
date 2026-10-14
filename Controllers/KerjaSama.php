<?php

namespace App\Controllers;
use App\Models\kerjaSamaModel;

class KerjaSama extends BaseController
{    
    public function kerjaSama()
    {
        $newsModel = new kerjaSamaModel();
        $data['kerjaSama'] = $newsModel->orderBy('id')->findAll(); 
        
        $data['title'] = 'Kerja Sama - Disdukcapil Sergai';
        return view('perjanjian-kerja-sama', $data);
    }   

   
    
}
