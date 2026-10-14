<?= $this->extend('layouts/main') ?> <?= $this->section('content') ?>
<div class="container main-content">
  <div class="page-banner">
    <h1><i class="fas fa-handshake"></i> Perjanjian Kerja Sama</h1>
    <p>Dokumen Kerja Sama dengan Berbagai Instansi dan Lembaga</p>
  </div>

  <div class="breadcrumbs">
    <a href="<?= base_url('index') ?>">Beranda</a> / <span>Perjanjian Kerja Sama</span>
  </div>

  <div class="page-intro">
    <h3>
      <i class="fas fa-file-contract" style="color: var(--dark-green)"></i>
      Koleksi Daftar Perjanjian Kerja Sama
    </h3>
    <p>
      Berikut adalah dokumen perjanjian kerja sama (PKS) yang telah
      ditandatangani oleh Dinas Kependudukan dan Pencatatan Sipil dengan
      berbagai mitra strategis.
    </p>
  </div>

  <div class="pks-grid">
    <?php if (!empty($kerjaSama) && is_array($kerjaSama)): ?>
    <?php foreach ($kerjaSama as $item): ?>
    <div class="pks-card">
      <div class="img-wrapper">
        <img src="<?= base_url('uploads/images/kerjasama/' .$item['kerjaSama_img'] ) ?>"/>
      </div>
    </div>
    <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Perjanjian Kerja Sama yang ditemukan.</p>
        <?php endif; ?>    
  </div>
</div>

<?= $this->endSection() ?>
