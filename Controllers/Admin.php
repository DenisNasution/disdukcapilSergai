<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\kepegawaianModel;

class Admin extends BaseController
{
    
    public function dashboard()
    {
        $kepegawaianModel = new kepegawaianModel();

        $data['count_kepegawaian'] = $kepegawaianModel->countAllResults();
    
        $data['title'] = 'Dashboard';
        
        return view('admin/dashboard', $data);
    }
}