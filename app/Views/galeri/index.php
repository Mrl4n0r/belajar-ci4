<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4">
    <div>
        <h1 class="h3 mb-1"><?= esc($title) ?></h1>
        <p class="text-muted mb-0">Pilih kategori untuk memfilter galeri foto.</p>
    </div>
</div>

<div class="mb-4">
    <a href="<?= base_url('galeri') ?>" class="btn btn-sm <?= empty($selectedKategori) ? 'btn-primary' : 'btn-outline-primary' ?> me-2 mb-2">Semua</a>
    <?php foreach ($kategori as $kat): ?>
        <a href="<?= base_url('galeri') . '?kategori=' . urlencode($kat) ?>" class="btn btn-sm <?= ($selectedKategori === $kat) ? 'btn-primary' : 'btn-outline-primary' ?> me-2 mb-2"><?= esc(ucfirst($kat)) ?></a>
    <?php endforeach; ?>
</div>

<div class="row">
    <?php if (empty($items)): ?>
        <div class="col-12">
            <div class="alert alert-warning">Tidak ada gambar untuk kategori <strong><?= esc($selectedKategori) ?></strong>.</div>
        </div>
    <?php endif; ?>

    <?php foreach ($items as $item): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="<?= esc($item['url_gambar'], 'attr') ?>"
                    class="card-img-top img-fluid"
                    style="height: 220px; object-fit: cover;"
                    loading="lazy"
                    alt="<?= esc($item['judul'], 'attr') ?>"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Gambar+tidak+tersedia';">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= esc($item['judul']) ?></h5>
                    <span class="badge bg-secondary mb-2 text-capitalize"><?= esc($item['kategori']) ?></span>
                    <p class="card-text mb-4"><?= esc(truncate_text($item['deskripsi'], 120)) ?></p>
                    <div class="mt-auto">
                        <a href="<?= base_url('galeri') . '?kategori=' . urlencode($item['kategori']) ?>" class="btn btn-sm btn-outline-primary">Lihat kategori</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>