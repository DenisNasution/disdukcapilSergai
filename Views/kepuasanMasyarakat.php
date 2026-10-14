
<?= $this->extend('layouts/main') ?> <?= $this->section('content') ?>

<div class="container main-content">
  
  <div class="page-banner">
    <h1>Indeks Kepuasan Masyarakat</h1>
    <p>Hasil Survei Pelayanan Publik Triwulanan</p>
  </div>

  
  <div class="breadcrumbs">
    <a href="<?= base_url('index') ?>">Beranda</a> / <span>Kepuasan Masyarakat</span>
  </div>

  
  <div class="page-intro">
    <h3>
      <i class="fas fa-star" style="color: #ffc107"></i> Kinerja Pelayanan
    </h3>
    <p>
      Berikut adalah hasil pengukuran Indeks Kepuasan Masyarakat (IKM) terhadap
      pelayanan administrasi kependudukan selama tahun 2026. Nilai maksimal
      adalah 100.
    </p>
  </div>

  
  <div class="survey-grid">
    
     <?php if (!empty($kepuasan) && is_array($kepuasan)): ?>
            <?php foreach ($kepuasan as $item): ?>
    <div class="survey-card status-excellent">
      <div class="survey-img-wrapper">
        <img
          src="<?=  base_url('uploads/images/kepuasan/' . $item[ 'kepuasan_img']) ?>"
          alt="<?= esc($item['kepuasan_img']) ?>"
        />
      </div>
      <div class="survey-info">
        <div class="period"><?= esc($item['kepuasan_desc']) ?></div>
        <div class="year">
          <i class="far fa-calendar-alt"></i> Jan - Mar Tahun 2025
        </div>
        <div class="score-badge" style="background-color: var(--primary-green)">
          <?= esc($item['kepuasan_score']) ?>
        </div>
        <div class="score-label">Sangat Baik</div>
      </div>
    </div>
    <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Kepuasan Masyarakat yang ditemukan.</p>
        <?php endif; ?>

  
  </div>
</div>
<?= $this->endSection() ?>
