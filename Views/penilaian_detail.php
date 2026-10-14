<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

 
    <div class="container main-content">
      <div class="page-banner">
        <h1>Penilaian Kinerja Dinas Dukcapil</h1>
        <?php /** @var array $main_item */ ?>
        <p><?= esc($main_item['penilaian_name']) ?></p> 
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('penilaian') ?>">Penilaian</a> / <span>Dokumen Pendukung</span>
      </div>

      <a href="<?= base_url('penilaian') ?>" class="back-btn"
        ><i class="fas fa-arrow-left"></i> Kembali ke Daftar Penilaian</a
      >
      
      <div class="doc-card-grid">
        <?php if (!empty($main_item['list_items']) && is_array($main_item['list_items'])): ?>
            <?php foreach ($main_item['list_items'] as $item): ?>
        <div class="image-card">
          <div class="img-wrapper">
            <img
             src="<?= base_url('uploads/images/nilai/' . $item['penilaian_list_img']) ?>"
              alt="Halaman 1"
            />
          </div>
        </div>

             <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penilaian <?= esc($main_item['penilaian_name']) ?>  yang ditemukan.</p>
        <?php endif; ?>
      </div>
    </div>
 <?= $this->endSection() ?>
