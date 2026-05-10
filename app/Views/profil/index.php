<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="bi bi-person-circle"></i> Profil Mahasiswa</h3>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted mb-1">NPM</h6>
                            <p class="mb-0"><?= esc($npm) ?></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted mb-1">Nama Lengkap</h6>
                            <p class="mb-0"><?= esc($nama) ?></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted mb-1">Program Studi</h6>
                            <p class="mb-0"><?= esc($prodi) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted mb-1">Angkatan</h6>
                            <p class="mb-0"><?= esc($angkatan) ?></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted mb-1">IPK</h6>
                            <p class="mb-0">
                                <span class="badge bg-<?= esc($ipk_badge) ?> fs-6"><?= esc(number_format($ipk, 2)) ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <h5 class="mb-3">Mata Kuliah yang Sedang Diambil</h5>
                <div class="list-group">
                    <?php foreach ($mata_kuliah as $matkul): ?>
                        <div class="list-group-item list-group-item-action">
                            <?= esc($matkul) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>