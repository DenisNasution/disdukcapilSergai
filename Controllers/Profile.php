<?php

namespace App\Controllers;
use App\Models\profileModel;

class Profile extends BaseController
{
    
    public function profile()
    {
        $profileModel = new profileModel();
        $data['profile'] = $profileModel->findAll();         
        $data['title'] = 'Profile - Disdukcapil Sergai';
        return view('profile', $data);
    }   

    public function Penilaian_detail($id = null)
{
    $profileModel = new profileModel();
    $data['main_name'] = $profileModel->find($id);
    
        $data['main_item'] = $profileModel->getPenilaianWithList($id);
    
    if (!$data['main_item']) {
        return redirect()->to('/penilaian');
    }
    $data['title'] = 'Detail Penilaian - Disdukcapil Sergai';
    return view('penilaian_detail', $data);
}
    
}
