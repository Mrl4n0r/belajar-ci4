<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Galeri extends BaseController
{
    public function index(): string
    {
        $items = [
            [
                'judul'      => 'Sunrise di Pegunungan',
                'url_gambar' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=600',
                'deskripsi'  => 'Pemandangan pagi hari dengan cahaya hangat menyinari puncak gunung.',
                'kategori'   => 'alam',
            ],
            [
                'judul'      => 'Pantai Tropis',
                'url_gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600',
                'deskripsi'  => 'Pantai pasir putih dengan laut biru jernih.',
                'kategori'   => 'alam',
            ],
            [
                'judul'      => 'Kota di Malam Hari',
                'url_gambar' => 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=600',
                'deskripsi'  => 'Gedung pencakar langit dengan lampu kota di malam hari.',
                'kategori'   => 'kota',
            ],
            [
                'judul'      => 'Lansekap Desa',
                'url_gambar' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=600',
                'deskripsi'  => 'Sawah hijau dan suasana pedesaan yang tenang.',
                'kategori'   => 'alam',
            ],
            [
                'judul'      => 'Arsitektur Modern',
                'url_gambar' => 'https://images.unsplash.com/photo-1511818966892-d7d671e672a2?w=600',
                'deskripsi'  => 'Bangunan modern dengan desain geometris.',
                'kategori'   => 'kota',
            ],
            [
                'judul'      => 'Seni Jalanan',
                'url_gambar' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600',
                'deskripsi'  => 'Grafiti warna-warni khas budaya urban.',
                'kategori'   => 'kota',
            ],
        ];

        $selectedKategori = strtolower((string) $this->request->getGet('kategori'));

        $kategori = array_values(array_unique(array_column($items, 'kategori')));
        sort($kategori);

        if ($selectedKategori !== '') {
            $items = array_filter($items, function ($item) use ($selectedKategori) {
                return strtolower($item['kategori']) === $selectedKategori;
            });
        }

        $data = [
            'title'            => 'Galeri Foto',
            'items'            => $items,
            'kategori'         => $kategori,
            'selectedKategori' => $selectedKategori,
        ];

        return view('galeri/index', $data);
    }
}
