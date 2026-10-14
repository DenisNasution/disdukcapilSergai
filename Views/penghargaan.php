
<?= $this->extend('layouts/main') ?> <?= $this->section('content') ?>

<div class="container main-content">
  
  <div class="page-banner">
    <h1><i class="fas fa-trophy"></i> Penghargaan</h1>
    <p>Prestasi dan Pengakuan Kinerja Instansi</p>
  </div>

  
  <div class="breadcrumbs">
    <a href="<?= base_url('index') ?>">Beranda</a> / <span>Penghargaan</span>
  </div>

  
  <div class="page-intro">
    <h3>
      <i
        class="fas fa-star"
        style="
          color: linear-gradient(
            135deg,
            var(--primary-green),
            var(--dark-green)
          );
        "
      ></i>
      Koleksi Sertifikat Penghargaan
    </h3>
    <p>
      Berikut adalah daftar penghargaan dan sertifikat yang telah diterima oleh
      Dinas Kependudukan dan Pencatatan Sipil atas dedikasi dan kinerja dalam
      pelayanan publik.
    </p>
  </div>

  
  <div class="penghargaan-grid">
    <?php if (!empty($penghargaan) && is_array($penghargaan)): ?>
            <?php foreach ($penghargaan as $item): ?>
    
    <div class="cert-card">
      <div class="img-wrapper">
        <img
          src="<?=  base_url('uploads/images/penghargaan/'. $item['penghargaan_img']) ?>"
          alt="<?= esc($item['penghargaan_img']) ?> "
        />
      </div>
    </div>
<?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penghargaan yang ditemukan.</p>
        <?php endif; ?>
  </div>
</div>
<?= $this->endSection() ?>
