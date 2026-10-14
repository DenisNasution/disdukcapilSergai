<?php

namespace App\Controllers;
use App\Models\jadiTauModel;

class JadiTau extends BaseController
{    
    public function jadiTau()
    {
        $newsModel = new jadiTauModel();
        $data['jadiTau'] = $newsModel->orderBy('id', 'ASC')->findAll(); // Grabs all rows from the 'news' table
        
        $data['title'] = 'Jadi Tau - Disdukcapil Sergai';
        return view('jaditau-adminduk', $data);
    }   

   
    
}
