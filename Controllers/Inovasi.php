<?php

namespace App\Controllers;
use App\Models\inovasiModel;

class Inovasi extends BaseController
{    
    public function inovasi()
    {
        $newsModel = new inovasiModel();
        $data['inovasi'] = $newsModel->getInovasiWithImages();; // Grabs all rows from the 'news' table
        
        $data['title'] = 'Inovasi - Disdukcapil Sergai';
        return view('inovasi', $data);
    }   

   
    
}
