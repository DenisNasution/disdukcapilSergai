<?php

namespace App\Controllers;

use App\Models\faqModel;

class Faq extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        helper('text');
        $this->faqModel = new faqModel();
    }

    public function faq()
    {
        $data['faq'] = $this->faqModel->orderBy('id')->findAll();         
        $data['title'] = 'FAQ - Disdukcapil Sergai';
        return view('faq', $data);
    }
}

