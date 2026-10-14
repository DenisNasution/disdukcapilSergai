<!-- app/Views/index.php -->
<?= $this->extend('layouts/main') ?> <?= $this->section('content') ?>

<div class="container main-content">
  <div class="page-banner">
    <h1>Penilaian Kinerja Dinas Dukcapil</h1>
    <p>Oleh Itkab Serdang Bedagai</p>
  </div>

  <div class="breadcrumbs">
    <a href="penilaian.html">Penilaian</a> / <span>Dokumen Pendukung</span>
  </div>

  <a href="<?= base_url('penilaian') ?>" class="back-btn"
    ><i class="fas fa-arrow-left"></i> Kembali ke Daftar Penilaian</a
  >

  <!-- Card Grid -->
  <div class="doc-card-grid">
    <!-- CARD 1 -->
    <div class="image-card">
      <div class="img-wrapper">
        <img src="assets/images/nilai/NilaiItkab23.JPG" alt="Halaman 1" />
      </div>
    </div>

    <!-- CARD 2 -->
    <div class="image-card">
      <div class="img-wrapper">
        <img src="assets/images/nilai/NilaiItkab24.JPG" alt="Halaman 2" />
      </div>
    </div>

    <!-- CARD 3 -->
    <div class="image-card">
      <div class="img-wrapper">
        <img src="assets/images/nilai/NilaiItkab25.JPG" alt="Halaman 3" />
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
