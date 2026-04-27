<?php
use CodeIgniter\Router\RouteCollection;
/**
* @var RouteCollection $routes
*/
// Route default (halaman beranda)
$routes->get('/', 'Beranda::index');
$routes->get('welcome', 'Beranda::index');
// Route halaman tentang
$routes->get('tentang', 'Beranda::tentang');
// Route dengan parameter numerik
$routes->get('pengguna/(:num)', 'Beranda::pengguna/$1');
// Route halaman waktu
$routes->get('waktu', 'Beranda::waktu');

// routes latihan 1
$routes->get('akademik', 'Akademik::index');
$routes->get('matkul', 'Akademik::matkul');
$routes->get('nilai/(:alphanum)', 'Akademik::nilai/$1');