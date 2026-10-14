
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


    <div class="container main-content">
      
      <div class="page-banner">
        <h1>Data Kependudukan</h1>
        <p>Informasi Statistik Penduduk dan Demografi</p>
      </div>

      
      <div class="breadcrumbs">
        <a href="<?= base_url('/') ?>">Beranda</a> / <span>Data Kependudukan</span>
      </div>

      
       
      <div class="data-grid">
        
        <div class="data-card">
          <div class="icon-wrapper icon-blue">
            <i class="fas fa-users"></i>
          </div>
          <h3>Jumlah Penduduk</h3>
          <?php /** @var string $JlPen */ ?>
          <div class="data-number">
          <?= number_format($JlPen, 0, ',', '.') ?></div>
          <div class="data-subtitle">Jiwa</div>
          <div
            style="
              margin-top: 15px;
              font-size: 0.8rem;
              color: #666;
              line-height: 1.6;
              width: 100%;
              text-align: center;
              border-top: 1px solid #eee;
              padding-top: 10px;
            "
          >
          <?php if (!empty($dataJkel) && is_array($dataJkel)): ?>
            <?php foreach ($dataJkel as $item): ?>
            <div><strong><?= esc($item['data_penduduk_name']) ?>:</strong>
             <?= number_format($item['data_penduduk_jmlh'], 0, ',', '.') ?>
            </div>
            
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penduduk yang ditemukan.</p>
        <?php endif; ?>
          </div>
        </div>

        
        <div class="data-card">
          <div class="icon-wrapper icon-green">
            <i class="fas fa-home"></i>
          </div>
          <h3>Kepala Keluarga</h3>
          <?php /** @var string $JlKkel */ ?>
          <div class="data-number">
          <?= number_format($JlKkel, 0, ',', '.') ?>
        </div>
          <div class="data-subtitle">KK</div>
          <div
            style="
              margin-top: 15px;
              font-size: 0.8rem;
              color: #666;
              line-height: 1.6;
              width: 100%;
              text-align: center;
              border-top: 1px solid #eee;
              padding-top: 10px;
            "
          >
          <?php if (!empty($datKKel) && is_array($datKKel)): ?>
            <?php foreach ($datKKel as $item): ?>
            <div><strong><?= esc($item['data_penduduk_name']) ?>:</strong> <?= number_format($item['data_penduduk_jmlh'], 0, ',', '.') ?></div>
            
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penduduk yang ditemukan.</p>
        <?php endif; ?>
          </div>
        </div>

        
        <div class="data-card">
          <div class="icon-wrapper icon-orange">
            <i class="fas fa-mosque"></i>
          </div>
          <h3>Pemeluk Agama</h3>
          <?php /** @var string $JlAgama */ ?>
          <div class="data-number"><?= esc($JlAgama) ?></div>
          <div class="data-subtitle">Agama</div>

          
          <div
            style="
              margin-top: 15px;
              font-size: 0.8rem;
              color: #666;
              line-height: 1.6;
              width: 100%;
              text-align: center;
              border-top: 1px solid #eee;
              padding-top: 10px;
            "
          >
          <?php if (!empty($dataAgama) && is_array($dataAgama)): ?>
            <?php foreach ($dataAgama as $item): ?>
            <div><strong><?= esc($item['data_penduduk_name']) ?>:</strong> <?= number_format($item['data_penduduk_jmlh'], 0, ',', '.') ?></div>
            
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penduduk yang ditemukan.</p>
        <?php endif; ?>
            
          </div>
        </div>

        
        <div class="data-card">
          <div class="icon-wrapper icon-purple">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>Tingkat Pendidikan</h3>
          <?php /** @var string $JlPendidikan */ ?>
          <div class="data-number"><?= esc($JlPendidikan) ?></div>
          <div class="data-subtitle">Jenjang</div>

          
          <div
            style="
              margin-top: 15px;
              font-size: 0.8rem;
              color: #666;
              line-height: 1.6;
              width: 100%;
              text-align: center;
              border-top: 1px solid #eee;
              padding-top: 10px;
            "
          >
            <?php if (!empty($dataPendidikan) && is_array($dataPendidikan)): ?>
            <?php foreach ($dataPendidikan as $item): ?>
            <div><strong><?= esc($item['data_penduduk_name']) ?>:</strong> <?= number_format($item['data_penduduk_jmlh'], 0, ',', '.') ?></div>
            
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penduduk yang ditemukan.</p>
        <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

<?= $this->endSection() ?>