<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'         => 'Profil Mahasiswa',
            'npm'           => '2310010375',
            'nama'          => 'Muhammad Maulana',
            'prodi'         => 'Teknik Informatika',
            'angkatan'      => '2023',
            'ipk'           => 3.80,
            'mata_kuliah'   => [
                'Keamanan Sistem Komputer',
                'Riset Oprasi',
                'Jaringan Syaraf Tiruan',
                'Fiqih',
                'Etika',
            ],
            'ipk_badge'     => $this->getIpkBadgeClass(3.80),
        ];

        return view('profil/index', $data);
    }

    private function getIpkBadgeClass(float $ipk): string
    {
        if ($ipk >= 3.5) {
            return 'success';
        }

        if ($ipk >= 3.0) {
            return 'warning';
        }

        return 'danger';
    }
}
