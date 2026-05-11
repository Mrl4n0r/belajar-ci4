<?php
/**
 * @var string $title
 * @var array $statistik
 */
?>
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class='d-flex justify-content-between align-items-center mb-4'>
    <div>
        <h2><i class='bi bi-bar-chart-fill'></i> Statistik Buku</h2>
        <p class='text-muted mb-0'>Ringkasan data inventaris buku</p>
    </div>
    <a href='<?= base_url('buku') ?>' class='btn btn-secondary'>
        <i class='bi bi-arrow-left'></i> Kembali
    </a>
</div>

<!-- Kartu Ringkasan -->
<div class='row mb-4'>
    <div class='col-md-4'>
        <div class='card bg-primary text-white shadow-sm'>
            <div class='card-body'>
                <h5 class='card-title'>Total Buku</h5>
                <h2 class='mb-0'><?= number_format($statistik['total']) ?></h2>
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class='card bg-success text-white shadow-sm'>
            <div class='card-body'>
                <h5 class='card-title'>Total Stok Keseluruhan</h5>
                <h2 class='mb-0'><?= number_format($statistik['total_stok']) ?></h2>
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class='card bg-info text-white shadow-sm'>
            <div class='card-body'>
                <h5 class='card-title'>Rata-rata Stok per Buku</h5>
                <h2 class='mb-0'><?= $statistik['rata_stok'] ?></h2>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <!-- Distribusi Kategori -->
    <div class='col-md-6 mb-4'>
        <div class='card shadow-sm h-100'>
            <div class='card-header bg-white'>
                <h5 class='mb-0'><i class='bi bi-pie-chart'></i> Distribusi per Kategori</h5>
            </div>
            <div class='card-body'>
                <?php if (empty($statistik['per_kategori'])): ?>
                    <p class='text-muted'>Belum ada data distribusi kategori.</p>
                <?php else: ?>
                    <div class='table-responsive'>
                        <table class='table table-bordered table-hover'>
                            <thead class='table-light'>
                                <tr>
                                    <th>Kategori</th>
                                    <th class='text-center'>Jumlah Buku</th>
                                    <th class='text-center'>Total Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($statistik['per_kategori'] as $k): ?>
                                    <tr>
                                        <td><?= esc($k['nama'] ?? 'Tanpa Kategori') ?></td>
                                        <td class='text-center'><?= $k['jumlah'] ?></td>
                                        <td class='text-center'><?= $k['total_stok_kategori'] ?? 0 ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Top Stok dan Stok Kosong -->
    <div class='col-md-6 mb-4'>
        <!-- Top 5 Stok -->
        <div class='card shadow-sm mb-4'>
            <div class='card-header bg-white'>
                <h5 class='mb-0'><i class='bi bi-sort-up'></i> 5 Buku Stok Terbanyak</h5>
            </div>
            <div class='card-body'>
                <?php if (empty($statistik['top_stok'])): ?>
                    <p class='text-muted'>Belum ada data buku.</p>
                <?php else: ?>
                    <ul class='list-group list-group-flush'>
                        <?php foreach ($statistik['top_stok'] as $b): ?>
                            <li class='list-group-item d-flex justify-content-between align-items-center px-0'>
                                <div>
                                    <h6 class='mb-0'><?= esc($b['judul']) ?></h6>
                                    <small class='text-muted'><?= esc($b['nama_kategori'] ?? '-') ?></small>
                                </div>
                                <span class='badge bg-success rounded-pill'><?= $b['stok'] ?> stok</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stok Kosong -->
        <div class='card shadow-sm border-danger'>
            <div class='card-header bg-danger text-white'>
                <h5 class='mb-0'><i class='bi bi-exclamation-triangle'></i> Perlu Restock (Stok 0)</h5>
            </div>
            <div class='card-body'>
                <?php if (empty($statistik['stok_kosong'])): ?>
                    <p class='text-muted mb-0'>Semua buku memiliki stok tersedia.</p>
                <?php else: ?>
                    <ul class='list-group list-group-flush'>
                        <?php foreach ($statistik['stok_kosong'] as $b): ?>
                            <li class='list-group-item d-flex justify-content-between align-items-center px-0'>
                                <div>
                                    <h6 class='mb-0'><?= esc($b['judul']) ?></h6>
                                    <small class='text-muted'><?= esc($b['kode_buku']) ?></small>
                                </div>
                                <a href='<?= base_url('buku/edit/' . $b['id']) ?>' class='btn btn-sm btn-outline-danger'>
                                    Restock
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
