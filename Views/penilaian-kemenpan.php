<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
      <div class="page-banner">
        <h1>Penilaian Kinerja Dinas Dukcapil</h1>
        <p>Oleh KemenpanRB</p>
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
              src="assets/images/nilai/NilaiMenpanRB21.JPG"
              alt="Halaman 1"
            />
          </div>
        </div>

        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiMenpanRB22.JPG"
              alt="Halaman 2"
            />
          </div>
        </div>

        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiMenpanRB24.JPG"
              alt="Halaman 3"
            />
          </div>
        </div>

        <div class="image-card">
          <div class="img-wrapper">
            <img
              src="assets/images/nilai/NilaiMenpanRB25.JPG"
              alt="Halaman 4"
            />
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection() ?>
