<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
      <div class="page-banner">
        <h1>
          <i class="fas fa-clipboard-list"></i> Persyaratan Pengurusan Dokumen
        </h1>
        <p>
          Pilih kategori untuk melihat daftar persyaratan yang harus disiapkan
        </p>
      </div>

      <div class="breadcrumbs">
        <a href="index.html">Beranda</a> / <span>Persyaratan Dokumen</span>
      </div>

      <div class="page-intro">
        <h3>
          <i class="fas fa-file-signature" style="color: var(--primary-green);"></i> Panduan
          Persyaratan Adminduk
        </h3>
        <p>
          Silakan pilih jenis dokumen yang ingin Anda urus pada menu dropdown di
          bawah ini untuk melihat persyaratan lengkap yang harus dibawa.
        </p>
      </div>

      <div class="filter-section">
        <label for="docCategory"
          ><i class="fas fa-filter"></i> Pilih Kategori Dokumen:</label
        >
        <select id="docCategory" onchange="filterDocuments()">
          <option value="">-- Silakan Pilih --</option>
          <?php if (!empty($persyaratan) && is_array($persyaratan)): ?>
    <?php foreach ($persyaratan as $item): ?>
          <option value="<?= esc($item['persyaratan_img']) ?>">
            <?= esc($item['persyaratan_name']) ?>
          </option>         
          <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Perjanjian Kerja Sama yang ditemukan.</p>
        <?php endif; ?>
        </select>
      </div>

      <script>
            window.persyaratanDataFromPHP = <?= json_encode($persyaratan ?? []) ?>;
        </script>
      <div class="image-grid-container" id="imageContainer">
        <div class="image-grid" id="imageGrid">
        </div>
      </div>
    </div>

<?= $this->endSection() ?>

