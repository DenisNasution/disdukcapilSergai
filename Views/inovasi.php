
<?= $this->extend('layouts/main') ?> 
<?= $this->section('content') ?>

<div class="container main-content">
  
  <div class="page-banner">
    <h1><i class="fas fa-lightbulb"></i> Inovasi Pelayanan</h1>
    <p>
      Terobosan dan Kreativitas dalam Penyelenggaraan Administrasi Kependudukan
    </p>
  </div>

  
  <div class="breadcrumbs">
    <a href="<?= base_url('index') ?>">Beranda</a> / <span>Inovasi</span>
  </div>

  
  <div class="page-intro">
    <h3>
      <i class="fas fa-rocket" style="color: var(--dark-green)"></i> Program
      Unggulan dan Inovasi
    </h3>
    <p>
      Kami senantiasa berinovasi untuk memberikan pelayanan yang lebih cepat,
      mudah, dan transparan kepada masyarakat melalui berbagai program
      kolaboratif dan peningkatan kapasitas.
    </p>
  </div>
  <?php if (!empty($inovasi) && is_array($inovasi)): ?>
        <?php foreach ($inovasi as $cat): ?>
            
            
            <div class="category-section">
                <div class="category-header">
                    <i class="fas fa-handshake"></i>
                    <h2><?= esc($cat['inovasi_name']) ?></h2>
                </div>

                <div class="inovasi-grid">
                    <?php if (!empty($cat['list_items'])): ?>
                        <?php foreach ($cat['list_items'] as $img): ?>
                            
                            
                            <div class="inovasi-card">
                                <div class="img-wrapper">
                                    <img src="<?= base_url('uploads/images/inovasi/' . $img['inovasi_list_img']) ?>" alt="<?= esc($cat['inovasi_name']) ?>" />
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="grid-column: 1/-1; text-align: center; color: #777;">Belum ada gambar untuk inovasi ini.</p>
                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; color: #777;">Belum ada data inovasi.</p>
    <?php endif; ?>

  
</div>

<?= $this->endSection() ?>
