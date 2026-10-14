<?php

namespace App\Controllers;
use App\Models\peraturanModel;

class Peraturan extends BaseController
{    
   public function peraturan()
{
    $peraturanModel = new peraturanModel();
    
    $data['skPelayanan'] = $peraturanModel->getSkPelayanan();
    $data['perUU'] = $peraturanModel->getPerUU();
    
    $data['title'] = 'Peraturan - Disdukcapil Sergai';
    return view('peraturan', $data);
}

   
    
}
