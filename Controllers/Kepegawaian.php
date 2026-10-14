<?php

namespace App\Controllers;
use App\Models\kepegawaianModel;

class Kepegawaian extends BaseController
{    
   public function kepegawaian()
{
    $kepegawaianModel = new kepegawaianModel();
    
    $data['struktur'] = $kepegawaianModel->getStruktur();
    $data['pegawai_terbaik'] = $kepegawaianModel->getPegawaiTerbaik();
    $data['data_pegawai'] = $kepegawaianModel->getDataPegawai();
    
    $data['title'] = 'Kepegawaian - Disdukcapil Sergai';
    return view('kepegawaian', $data);
}

   
    
}
