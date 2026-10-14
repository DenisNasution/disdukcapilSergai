
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

 
    <div class="container main-content">
      
      <div class="page-banner">
        <h1>JADI TAU ADMINDUK</h1>
        <p>Info Lengkap Seputar Pelayanan Administrasi Kependudukan</p>
      </div>

      
      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> / <span>JADI TAU ADMINDUK</span>
      </div>

      
      <div class="page-intro">
        <h3>
          <i class="fas fa-info-circle" style="color: white"></i> Yuk, Kenali
          Pelayanan Kami!
        </h3>
        <p>
          Berikut adalah informasi lengkap mengenai komitmen pelayanan, alur,
          biaya, dan hal-hal penting lainnya yang perlu Anda ketahui sebelum
          mengurus dokumen kependudukan.
        </p>
      </div>

      
      <div class="jaditau-grid">
         <?php if (!empty($jadiTau) && is_array($jadiTau)): ?>
            <?php foreach ($jadiTau as $item): ?>
        
        <div class="info-card">
          <div class="img-wrapper">
            <img
              src="<?=  base_url('uploads/images/jadiTau/'. $item['jadiTau_img']) ?>"
              alt="Komitmen PRIMA"
            />
          </div>
          <div class="card-footer">
            <h3><?= esc($item['jadiTau_name']) ?></h3>
            <p><?= strip_tags($item['jadiTau_desc'], '<strong><b><i><em><br><span>') ?></p>
          </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penghargaan yang ditemukan.</p>
        <?php endif; ?>
      </div>
    </div>
    
<?= $this->endSection() ?>
