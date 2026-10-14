<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
      <div class="page-banner">
        <h1>Penilaian Kinerja Dinas Dukcapil</h1>
        <p>Oleh Ombudsman</p>
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('penilaian') ?>">Penilaian</a> / <span>Dokumen Pendukung</span>
      </div>

      <a href="<?= base_url('penilaian') ?>" class="back-btn"
        ><i class="fas fa-arrow-left"></i> Kembali ke Daftar Penilaian</a
      >

      <div class="doc-card-grid">
        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiOmbudsan22.JPG"
              alt="Halaman 1"
            />
          </div>
          <div class="card-footer">
            <div class="score-badge" style="margin-top: 10px">97.16</div>
          </div>
        </div>

        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiOmbudsan23.JPG"
              alt="Halaman 2"
            />
          </div>
          <div class="card-footer">
            <div class="score-badge" style="margin-top: 10px">97.16</div>
          </div>
        </div>

        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiOmbudsan24.JPG"
              alt="Halaman 3"
            />
          </div>
          <div class="card-footer">
            <div class="score-badge" style="margin-top: 10px">97.16</div>
          </div>
        </div>
      </div>
    </div>

<?= $this->endSection() ?>
