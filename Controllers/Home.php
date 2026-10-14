<?php

namespace App\Controllers;
use App\Models\berandaModel;

class Home extends BaseController
{
    protected $berandaModel;

    public function __construct()
    {
        $this->berandaModel = new berandaModel();
    }
    public function index(): string
    {
         $data['carrousel'] = $this->berandaModel->select()->where('beranda_kat_id', 1)->findAll();
         $data['gallery'] = $this->berandaModel->select()->where('beranda_kat_id', 2)->orderBy('id')->findAll();
         $data['title'] = 'Beranda - Disdukcapil Sergai';
        return view('index', $data);
    }
    // public function faq()
    // {
    //     $data['title'] = 'FAQ - Disdukcapil Sergai';
    //     return view('FAQ', $data);
    // }
    public function hubungi_kami()
    {
        $data['title'] = 'Hubungi Kami - Disdukcapil Sergai';
        return view('hubungi-kami', $data);
    }

    
    
}
