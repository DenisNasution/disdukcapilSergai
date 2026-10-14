<?php

namespace App\Controllers;
use App\Models\pendudukModel;

class Penduduk extends BaseController
{    
   public function penduduk()
{
    $pendudukModel = new pendudukModel();
    
    $data['dataJkel'] = $pendudukModel->getJkel();
    $data['datKKel'] = $pendudukModel->getKKel();
    $data['dataAgama'] = $pendudukModel->getAgama();
    $data['dataPendidikan'] = $pendudukModel->getPendidikan();

    $data['JlPen'] = $data['dataJkel'][0]["data_penduduk_jmlh"] + $data['dataJkel'][1]["data_penduduk_jmlh"];

    $data['JlKkel'] = $data['datKKel'][0]["data_penduduk_jmlh"] + $data['datKKel'][1]["data_penduduk_jmlh"];

    $data['JlAgama'] = count($data['dataAgama']);

    $data['JlPendidikan'] = count($data['dataPendidikan']);
    
    $data['title'] = 'Data Kependudukan - Disdukcapil Sergai';
    return view('kependudukan', $data);
}

   
    
}
