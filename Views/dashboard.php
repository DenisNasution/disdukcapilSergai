<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<div class="dashboard-grid">
    
    <div class="admin-card">
        <div class="card-icon blue"><i class="fas fa-newspaper"></i></div>
        <h3><?= $count_berita ?? 0 ?></h3>
        <p>Berita</p>
        <a href="<?= base_url('admin/berita') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-users"></i></div>
        <h3><?= $count_kepegawaian ?? 0 ?></h3>
        <p>Kepegawaian</p>
        <a href="<?= base_url('admin/kepegawaian') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon orange"><i class="fas fa-chart-line"></i></div>
        <h3><?= $count_kependudukan ?? 0 ?></h3>
        <p>Data Kependudukan</p>
        <a href="<?= base_url('admin/kependudukan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon purple"><i class="fas fa-star"></i></div>
        <h3><?= $count_kepuasan ?? 0 ?></h3>
        <p>Kepuasan</p>
        <a href="<?= base_url('admin/kepuasan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon red"><i class="fas fa-clipboard-check"></i></div>
        <h3><?= $count_penilaian ?? 0 ?></h3>
        <p>Penilaian</p>
        <a href="<?= base_url('admin/penilaian') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon dark"><i class="fas fa-file-contract"></i></div>
        <h3><?= $count_peraturan ?? 0 ?></h3>
        <p>Peraturan</p>
        <a href="<?= base_url('admin/peraturan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon blue"><i class="fas fa-bullhorn"></i></div>
        <h3><?= $count_pengaduan ?? 0 ?></h3>
        <p>Pengaduan</p>
        <a href="<?= base_url('admin/pengaduan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon gold"><i class="fas fa-trophy"></i></div>
        <h3><?= $count_penghargaan ?? 0 ?></h3>
        <p>Penghargaan</p>
        <a href="<?= base_url('admin/penghargaan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon teal"><i class="fas fa-lightbulb"></i></div>
        <h3><?= $count_inovasi ?? 0 ?></h3>
        <p>Inovasi</p>
        <a href="<?= base_url('admin/inovasi') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon blue"><i class="fas fa-clipboard-list"></i></div>
        <h3><?= $count_persyaratan ?? 0 ?></h3>
        <p>Persyaratan</p>
        <a href="<?= base_url('admin/persyaratan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-info-circle"></i></div>
        <h3><?= $count_jaditau ?? 0 ?></h3>
        <p>JADI TAU</p>
        <a href="<?= base_url('admin/jaditau') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon purple"><i class="fas fa-images"></i></div>
        <h3><?= $count_galeri ?? 0 ?></h3>
        <p>Galeri</p>
        <a href="<?= base_url('admin/galeri') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

</div>

<?= $this->endSection() ?>