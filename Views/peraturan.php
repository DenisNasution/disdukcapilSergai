<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
      <div class="page-banner">
        <h1><i class="fas fa-file-contract"></i> Peraturan</h1>
        <p>Dokumen Hukum, SK, dan Peraturan Perundang-Undangan</p>
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> /
        <span id="breadcrumb-title">Peraturan</span>
      </div>

      <div class="page-intro">
        <h3>
          <i class="fas fa-gavel" style="color: var(--dark-green)"></i> Pusat
          Data Hukum Pelayanan Adminduk
        </h3>
        <p>
          Berikut adalah kumpulan peraturan yang menjadi landasan hukum dalam
          penyelenggaraan pelayanan administrasi kependudukan.
        </p>
      </div>

      <div class="peraturan-grid">
        <script>
            window.skPelayananDataFromPHP = <?= json_encode($skPelayanan ?? []) ?>;
            window.perUUDataFromPHP = <?= json_encode($perUU ?? []) ?>;
        </script>
        <aside class="peraturan-sidebar">
          <h3>Kategori Peraturan</h3>
          <ul class="sidebar-menu">
            <li>
              <a
                href="#"
                onclick="loadPeraturanContent('sk', this)"
                class="active"
                >SK Pelayanan Adminduk</a
              >
            </li>
            <li>
              <a href="#" onclick="loadPeraturanContent('undang', this)"
                >Peraturan Perundang-Undangan</a
              >
            </li>
          </ul>
        </aside>

        <main class="peraturan-content" id="dynamic-content">
          <div class="loader" id="loader" style="display: none">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
          </div>
        </main>
      </div>
    </div>

<?= $this->endSection() ?>