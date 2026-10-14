<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<div class="dashboard-grid">

    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-home"></i></div>
        <p>Beranda</p>
        <a href="<?= base_url('admin/beranda/'. 1 .'/slider')?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-clipboard-check"></i></div>
        <p>Profile</p>
        <a href="<?= base_url('admin/visimisi')?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-users"></i></div>
        <p>Kepegawaian</p>
        <a href="<?= base_url('admin/struktur') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon orange"><i class="fas fa-chart-line"></i></div>
        <p>Data Kependudukan</p>
        <a href="<?= base_url('admin/datapend') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon purple"><i class="fas fa-star"></i></div>
        <p>Kepuasan</p>
        <a href="<?= base_url('admin/kepuasan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon red"><i class="fas fa-clipboard-check"></i></div>
        <p>Penilaian</p>
        <a href="<?= base_url('admin/penilaian/'. 1 . '/kemendagri') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon dark"><i class="fas fa-file-contract"></i></div>
        <p>Peraturan</p>
        <a href="<?= base_url('admin/peruu') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon blue"><i class="fas fa-bullhorn"></i></div>
        <p>Pengaduan</p>
        <a href="<?= base_url('admin/pengaduan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon gold"><i class="fas fa-trophy"></i></div>
        <p>Penghargaan</p>
        <a href="<?= base_url('admin/penghargaan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon teal"><i class="fas fa-handshake"></i></div>
        <p>Kerja Sama</p>
        <a href="<?= base_url('admin/kerjasama') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon teal"><i class="fas fa-lightbulb"></i></div>
        <p>Inovasi</p>
        <a href="<?= base_url('admin/inovasi/'. 1 . '/kolaborasi') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon blue"><i class="fas fa-clipboard-list"></i></div>
        <p>Persyaratan</p>
        <a href="<?= base_url('admin/persyaratan') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-info-circle"></i></div>
        <p>JADI TAU</p>
        <a href="<?= base_url('admin/jaditau') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-comments"></i></div>
        <p>Tanya Jawab</p>
        <a href="<?= base_url('admin/qna') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="admin-card">
        <div class="card-icon green"><i class="fas fa-question-circle"></i></div>
        <p>FAQ</p>
        <a href="<?= base_url('admin/faq') ?>" class="card-link">Kelola <i class="fas fa-arrow-right"></i></a>
    </div>

</div>

<?= $this->endSection() ?>