<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'isbn',
        'deskripsi',
        'stok',
        'kategori_id'
    ];

    /** 
     * Ambil semua buku beserta nama kategorinya (JOIN) 
     */
    public function getBukuDenganKategori(): array
    {
        return $this
            ->select('buku.*, kategori.nama AS nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->orderBy('buku.judul', 'ASC')
            ->findAll();
    }

    /** 
     * Cari buku berdasarkan keyword di judul atau penulis 
     */
    public function cari(string $keyword): array
    {
        return $this
            ->select('buku.*, kategori.nama AS nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->groupStart()
            ->like('buku.judul', $keyword)
            ->orLike('buku.penulis', $keyword)
            ->orLike('buku.penerbit', $keyword)
            ->groupEnd()
            ->orderBy('buku.judul', 'ASC')
            ->findAll();
    }

    /** 
     * Ambil buku dengan paginasi dan JOIN kategori 
     */
    public function getBukuPaginate(int $perPage = 10, string $keyword = '')
    {
        $this->select('buku.*, kategori.nama AS nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->orderBy('buku.judul', 'ASC');
        if (!empty($keyword)) {
            $this->groupStart()
                ->like('buku.judul', $keyword)
                ->orLike('buku.penulis', $keyword)
                ->groupEnd();
        }

        return $this->paginate($perPage);
    }

    /** 
     * Cek apakah kode buku sudah ada (untuk validasi unik saat edit) 
     */
    public function isKodeTaken(string $kode, int $excludeId = 0): bool
    {
        $qb = $this->where('kode_buku', $kode);
        if ($excludeId > 0) {
            $qb->where('id !=', $excludeId);
        }
        return $qb->countAllResults() > 0;
    }

    /** 
     * Ambil statistik buku 
     */
    public function getStatistik(): array
    {
        $db = \Config\Database::connect();
        
        $totalBuku = $this->countAll();
        $totalStok = (int) $db->table('buku')->selectSum('stok')->get()->getRow()->stok;
        
        return [
            'total'          => $totalBuku,
            'total_stok'     => $totalStok,
            'rata_stok'      => $totalBuku > 0 ? round($totalStok / $totalBuku, 2) : 0,
            'per_kategori'   => $db->table('buku')
                ->select('kategori.nama, COUNT(buku.id) AS jumlah, SUM(buku.stok) AS total_stok_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
                ->groupBy('kategori.id')
                ->orderBy('jumlah', 'DESC')
                ->get()->getResultArray(),
            'top_stok'       => $db->table('buku')
                ->select('buku.*, kategori.nama AS nama_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
                ->orderBy('stok', 'DESC')
                ->limit(5)
                ->get()->getResultArray(),
            'stok_kosong'    => $db->table('buku')
                ->select('buku.*, kategori.nama AS nama_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
                ->where('stok', 0)
                ->get()->getResultArray(),
        ];
    }
}
