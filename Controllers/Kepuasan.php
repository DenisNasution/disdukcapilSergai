<?php

namespace App\Controllers;
use App\Models\kepuasanModel;

class Kepuasan extends BaseController
{
    
    public function kepuasanMasyarakat()
    {
        $newsModel = new kepuasanModel();
        $data['kepuasan'] = $newsModel->orderBy('id')->findAll(); 
        
        $data['title'] = 'Kepuasan Masyarakat - Disdukcapil Sergai';
        return view('kepuasanMasyarakat', $data);
    }   
    
}
