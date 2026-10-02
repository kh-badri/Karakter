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

    // --- RUTE DATA KARAKTER (Dataset) ---
    $routes->get('/data-karakter', 'DataKarakter::index');
    $routes->post('/data-karakter/save', 'DataKarakter::save');
    
    // [BARU] Rute untuk Update/Edit Data
    $routes->post('/data-karakter/update/(:num)', 'DataKarakter::update/$1'); 
    
    $routes->post('/data-karakter/upload', 'DataKarakter::upload');
    $routes->get('/data-karakter/hapus-semua', 'DataKarakter::hapusSemua');
    $routes->get('/data-karakter/delete/(:num)', 'DataKarakter::delete/$1');

    // --- RUTE KLASIFIKASI ---
    $routes->get('/klasifikasi', 'Klasifikasi::index');
    $routes->post('/klasifikasi/proses', 'Klasifikasi::proses');
    $routes->post('/klasifikasi/simpan', 'Klasifikasi::simpan');

    // --- RUTE HISTORY ---
    $routes->get('/history', 'History::index');
    $routes->get('/history/delete/(:num)', 'History::delete/$1');
    $routes->get('/history/hapus-semua', 'History::hapusSemua');
    $routes->get('/history/detail/(:num)', 'History::detail/$1');

});


// --- RUTE UNTUK TAMU (Dijaga oleh 'guest') ---
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->get('register', 'Auth::register', ['as' => 'register']);
});


// --- RUTE AKSI PUBLIK ---
$routes->post('login', 'Auth::login');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');