<?php

namespace App\Controllers;
use App\Models\penghargaanModel;

class Penghargaan extends BaseController
{    
    public function penghargaan()
    {
        $newsModel = new penghargaanModel();
        $data['penghargaan'] = $newsModel->orderBy('id')->findAll(); 
        
        $data['title'] = 'Penghargaan - Disdukcapil Sergai';
        return view('penghargaan', $data);
    }   

   
    
}
