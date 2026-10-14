<?php

namespace App\Controllers;
use App\Models\penilaianModel;

class Penilaian extends BaseController
{
    
    public function penilaian()
    {
        $newsModel = new penilaianModel();
        $data['penilaian'] = $newsModel->findAll(); 
        
        $data['title'] = 'Penilaian - Disdukcapil Sergai';
        return view('penilaian', $data);
    }   

    public function Penilaian_detail($id = null)
{
    $penilaianModel = new penilaianModel();
    $data['main_name'] = $penilaianModel->find($id);
    
    $data['main_item'] = $penilaianModel->getPenilaianWithList($id);
    
    if (!$data['main_item']) {
        return redirect()->to('/penilaian');
    }
    $data['title'] = 'Detail Penilaian - Disdukcapil Sergai';
    return view('penilaian_detail', $data);
}
    
}
