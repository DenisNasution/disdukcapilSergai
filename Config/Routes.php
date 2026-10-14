<?php

namespace Config;


$routes = Services::routes();



if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->get('/', 'Home::index');

$routes->get('/hubungi_kami', 'Home::hubungi_kami');

$routes->get('/faq', 'Faq::faq');

$routes->get('/profile', 'Profile::profile');

$routes->get('/kependudukan', 'Penduduk::penduduk');

$routes->get('/peraturan', 'Peraturan::peraturan');

$routes->get('/persyaratan', 'Persyaratan::persyaratan');

$routes->get('/kepegawaian', 'Kepegawaian::kepegawaian');

$routes->get('/pengaduan', 'Pengaduan::pengaduan');

$routes->get('/penilaian', 'Penilaian::penilaian');
$routes->get('/penilaian_detail/(:num)', 'Penilaian::penilaian_detail/$1');

$routes->get('/penghargaan', 'Penghargaan::penghargaan');

$routes->get('/kepuasanMasyarakat', 'Kepuasan::kepuasanMasyarakat');

$routes->get('/kerjaSama', 'KerjaSama::kerjaSama');

$routes->get('/inovasi', 'Inovasi::inovasi');

$routes->get('/jadiTau', 'JadiTau::jadiTau');
$routes->get('/tanya-jawab', 'Qna::index');
$routes->post('/tanya-jawab/submit', 'Qna::submit');


$routes->get('/admin/login', 'Admin\Auth::login');
$routes->post('/admin/login/attempt', 'Admin\Auth::attemptLogin');
$routes->get('/admin/logout', 'Admin\Auth::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('penghargaan', 'Admin\Penghargaan::index');
    $routes->get('penghargaan/create', 'Admin\Penghargaan::create');
    $routes->post('penghargaan/store', 'Admin\Penghargaan::store'); 
    $routes->get('penghargaan/edit/(:segment)', 'Admin\Penghargaan::edit/$1');
    $routes->post('penghargaan/update/(:segment)', 'Admin\Penghargaan::update/$1'); 
    $routes->get('penghargaan/delete/(:segment)', 'Admin\Penghargaan::delete/$1');

    $routes->get('kepuasan', 'Admin\Kepuasan::index');
    $routes->get('kepuasan/create', 'Admin\Kepuasan::create');
     $routes->post('kepuasan/store', 'Admin\Kepuasan::store'); 
    $routes->get('kepuasan/edit/(:segment)', 'Admin\Kepuasan::edit/$1');
    $routes->post('kepuasan/update/(:segment)', 'Admin\Kepuasan::update/$1'); 
    $routes->get('kepuasan/delete/(:segment)', 'Admin\Kepuasan::delete/$1');

    $routes->get('kerjasama', 'Admin\KerjaSama::index');
    $routes->get('kerjasama/create', 'Admin\KerjaSama::create');
     $routes->post('kerjasama/store', 'Admin\KerjaSama::store'); 
    $routes->get('kerjasama/edit/(:segment)', 'Admin\KerjaSama::edit/$1');
    $routes->post('kerjasama/update/(:segment)', 'Admin\KerjaSama::update/$1'); 
    $routes->get('kerjasama/delete/(:segment)', 'Admin\KerjaSama::delete/$1');

    $routes->post('penilaian/store', 'Admin\Penilaian::store'); 
    $routes->get('penilaian/create/(:num)', 'Admin\Penilaian::create/$1');
    $routes->get('penilaian/(:num)/(:segment)', 'Admin\Penilaian::index/$1/$2');
    $routes->get('penilaian/edit/(:segment)', 'Admin\Penilaian::edit/$1');
    $routes->post('penilaian/update/(:segment)', 'Admin\Penilaian::update/$1'); 
    $routes->get('penilaian/delete/(:segment)', 'Admin\Penilaian::delete/$1');

    $routes->post('inovasi/store', 'Admin\Inovasi::store'); 
    $routes->get('inovasi/create/(:num)', 'Admin\Inovasi::create/$1');
    $routes->get('inovasi/(:num)/(:segment)', 'Admin\Inovasi::index/$1/$2');
    $routes->get('inovasi/edit/(:segment)', 'Admin\Inovasi::edit/$1');
    $routes->post('inovasi/update/(:segment)', 'Admin\Inovasi::update/$1'); 
    $routes->get('inovasi/delete/(:segment)', 'Admin\Inovasi::delete/$1');

    $routes->get('pengaduan', 'Admin\Pengaduan::index');
    $routes->get('pengaduan/create', 'Admin\Pengaduan::create');
    $routes->post('pengaduan/store', 'Admin\Pengaduan::store'); 
    $routes->get('pengaduan/edit/(:segment)', 'Admin\Pengaduan::edit/$1');
    $routes->post('pengaduan/update/(:segment)', 'Admin\Pengaduan::update/$1'); 
    $routes->get('pengaduan/delete/(:segment)', 'Admin\Pengaduan::delete/$1');

    $routes->get('persyaratan', 'Admin\Persyaratan::index');
    $routes->get('persyaratan/create', 'Admin\Persyaratan::create');
    $routes->post('persyaratan/store', 'Admin\Persyaratan::store'); 
    $routes->get('persyaratan/edit/(:segment)', 'Admin\Persyaratan::edit/$1');
    $routes->post('persyaratan/update/(:segment)', 'Admin\Persyaratan::update/$1'); 
    $routes->get('persyaratan/delete/(:segment)', 'Admin\Persyaratan::delete/$1');
    
    $routes->get('peruu', 'Admin\Peruu::index');
    $routes->get('peruu/create', 'Admin\Peruu::create');
    $routes->post('peruu/store', 'Admin\Peruu::store'); 
    $routes->get('peruu/edit/(:segment)', 'Admin\Peruu::edit/$1');
    $routes->post('peruu/update/(:segment)', 'Admin\Peruu::update/$1'); 
    $routes->get('peruu/delete/(:segment)', 'Admin\Peruu::delete/$1');
    
    $routes->get('skpelayanan', 'Admin\Skpelayanan::index');
    $routes->get('skpelayanan/create', 'Admin\Skpelayanan::create');
    $routes->post('skpelayanan/store', 'Admin\Skpelayanan::store'); 
    $routes->get('skpelayanan/edit/(:segment)', 'Admin\Skpelayanan::edit/$1');
    $routes->post('skpelayanan/update/(:segment)', 'Admin\Skpelayanan::update/$1'); 
    $routes->get('skpelayanan/delete/(:segment)', 'Admin\Skpelayanan::delete/$1');

    $routes->get('jaditau', 'Admin\JadiTau::index');
    $routes->get('jaditau/create', 'Admin\JadiTau::create');
    $routes->post('jaditau/store', 'Admin\JadiTau::store'); 
    $routes->get('jaditau/edit/(:segment)', 'Admin\JadiTau::edit/$1');
    $routes->post('jaditau/update/(:segment)', 'Admin\JadiTau::update/$1'); 
    $routes->get('jaditau/delete/(:segment)', 'Admin\JadiTau::delete/$1');
    
    $routes->get('visimisi', 'Admin\Visimisi::index');
    $routes->get('visimisi/edit/(:segment)', 'Admin\Visimisi::edit/$1');
    $routes->post('visimisi/update/(:segment)', 'Admin\Visimisi::update/$1'); 

    $routes->get('motto', 'Admin\Motto::index');
    $routes->get('motto/edit/(:segment)', 'Admin\Motto::edit/$1');
    $routes->post('motto/update/(:segment)', 'Admin\Motto::update/$1'); 

    $routes->get('maklumat', 'Admin\Maklumat::index');     
    $routes->get('maklumat/edit/(:segment)', 'Admin\Maklumat::edit/$1');
    $routes->post('maklumat/update/(:segment)', 'Admin\Maklumat::update/$1'); 
    $routes->get('maklumat', 'Admin\Maklumat::index');
    
    $routes->get('struktur', 'Admin\Struktur::index'); 
    $routes->get('struktur/edit/(:segment)', 'Admin\Struktur::edit/$1');
    $routes->post('struktur/update/(:segment)', 'Admin\Struktur::update/$1'); 

    $routes->get('pegterbaik', 'Admin\PegawaiTerbaik::index'); 
    $routes->get('pegterbaik/create', 'Admin\PegawaiTerbaik::create');
    $routes->post('pegterbaik/store', 'Admin\PegawaiTerbaik::store'); 
    $routes->get('pegterbaik/edit/(:segment)', 'Admin\PegawaiTerbaik::edit/$1');
    $routes->post('pegterbaik/update/(:segment)', 'Admin\PegawaiTerbaik::update/$1'); 
    $routes->get('pegterbaik/delete/(:segment)', 'Admin\PegawaiTerbaik::delete/$1');

    $routes->get('datapeg', 'Admin\DataPegawai::index'); 
    $routes->get('datapeg/edit/(:segment)', 'Admin\DataPegawai::edit/$1');
    $routes->post('datapeg/update/(:segment)', 'Admin\DataPegawai::update/$1'); 
    
    $routes->get('datapend', 'Admin\DataPenduduk::index'); 
    $routes->get('datapend/edit/(:segment)', 'Admin\DataPenduduk::edit/$1');
    $routes->post('datapend/update/(:segment)', 'Admin\DataPenduduk::update/$1'); 

    $routes->post('beranda/store', 'Admin\Beranda::store'); 
    $routes->get('beranda/create/(:num)', 'Admin\Beranda::create/$1');
    $routes->get('beranda/(:num)/(:segment)', 'Admin\Beranda::index/$1/$2');
    $routes->get('beranda/edit/(:segment)', 'Admin\Beranda::edit/$1');
    $routes->post('beranda/update/(:segment)', 'Admin\Beranda::update/$1'); 
    $routes->get('beranda/delete/(:segment)', 'Admin\Beranda::delete/$1');

    $routes->get('qna/detail/(:segment)', 'Admin\Qna::detail/$1');
    $routes->post('qna/submit-answer/(:segment)', 'Admin\Qna::submitAnswer/$1');
    $routes->post('qna/reject/(:segment)', 'Admin\Qna::reject/$1');
    $routes->get('qna/view-answer/(:segment)', 'Admin\Qna::viewAnswer/$1');
    $routes->get('qna/view-reject/(:segment)', 'Admin\Qna::viewReject/$1');
    $routes->get('qna/delete/(:segment)', 'Admin\Qna::delete/$1');
    $routes->get('qna/(:segment)', 'Admin\Qna::index/$1');
    $routes->get('qna', 'Admin\Qna::index');

    $routes->get('faq', 'Admin\Faq::index');
    $routes->get('faq/create', 'Admin\Faq::create');
    $routes->post('faq/store', 'Admin\Faq::store'); 
    $routes->get('faq/edit/(:segment)', 'Admin\Faq::edit/$1');
    $routes->post('faq/update/(:segment)', 'Admin\Faq::update/$1'); 
    $routes->get('faq/delete/(:segment)', 'Admin\Faq::delete/$1');
    
});