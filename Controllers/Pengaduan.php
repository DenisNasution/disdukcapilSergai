<?php

namespace App\Controllers;
use App\Models\pengaduanModel;

class Pengaduan extends BaseController
{    
    public function pengaduan()
    {
        $pengaduanModel  = new pengaduanModel();
        $data['pengaduanData'] = $pengaduanModel ->findAll(); 
        
        $data['title'] = 'Pengaduan - Disdukcapil Sergai';
        return view('pengaduan', $data);

    }   

   
    
}
