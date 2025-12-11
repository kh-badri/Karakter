<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTE YANG WAJIB LOGIN (Dijaga oleh 'auth') ---
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Rute utama aplikasi
    $routes->get('/', 'Home::index');
    $routes->addRedirect('home', '/');

    // Rute untuk halaman Akun
    $routes->get('akun', 'Akun::index');
    $routes->post('akun/update_profil', 'Akun::updateProfil');
    $routes->post('akun/update_sandi', 'Akun::updateSandi');

    // --- RUTE DATASET ---
    $routes->group('dataset', function ($routes) {
        $routes->get('/', 'Dataset::index');
        $routes->post('save', 'Dataset::save');
        $routes->post('upload', 'Dataset::upload');

        // Mengizinkan POST dan DELETE untuk hapusSemua
        $routes->match(['post', 'delete'], 'hapusSemua', 'Dataset::hapusSemua');

        // [PERBAIKAN DISINI] 
        // Mengubah 'get' menjadi 'post' karena form HTML menggunakan method="post"
        // Jika Anda menggunakan <input type="hidden" name="_method" value="DELETE">, 
        // Anda bisa menggunakan $routes->delete(...) atau $routes->match(['post', 'delete']...)
        $routes->post('delete/(:num)', 'Dataset::delete/$1');
    });

    // --- RUTE ANALISIS ---
    $routes->group('analisis', function ($routes) {
        $routes->get('/', 'Analisis::index');
        $routes->post('proses', 'Analisis::proses');
        $routes->post('simpan', 'Analisis::simpan');
    });

    // --- RUTE HISTORY ---
    $routes->group('history', function ($routes) {
        $routes->get('/', 'History::index');
        // [PERBAIKAN DISINI]
        // Gunakan 'match' agar bisa menerima POST (form biasa) atau DELETE (spoofing)
        $routes->match(['post', 'delete'], 'delete/(:num)', 'History::delete/$1');
        $routes->get('detail/(:num)', 'History::detail/$1');
    });
});


// --- RUTE UNTUK TAMU (Dijaga oleh 'guest') ---
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->get('register', 'Auth::register', ['as' => 'register']);
});


// --- RUTE AKSI PUBLIK ---
$routes->post('login', 'Auth::login');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout'); // Pastikan Auth::logout menggunakan GET atau sesuaikan