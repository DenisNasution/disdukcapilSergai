
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


    <div class="container main-content">
      
      <div class="page-banner">
        <h1>Kepegawaian</h1>
        <p>Informasi Sumber Daya Manusia Aparatur</p>
      </div>

      
      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> /
        <span id="breadcrumb-title">Kepegawaian</span>
      </div>

      
      <div class="kepegawaian-grid">
        <script>
            window.strukturDataFromPHP = <?= json_encode($struktur ?? []) ?>;
            window.pegawaiTerbaikDataFromPHP = <?= json_encode($pegawai_terbaik ?? []) ?>;
            window.pegawaiDataFromPHP = <?= json_encode($data_pegawai ?? []) ?>;
        </script>
        
        <aside class="kepegawaian-sidebar">
          <h3>Menu Kepegawaian</h3>
          <ul class="sidebar-menu">
            <li>
              <a
                href="#"
                onclick="loadKepegawaianContent('struktur', this)"
                class="active"
                >Struktur Organisasi</a
              >
            </li>
            <li>
              <a href="#" onclick="loadKepegawaianContent('data-pegawai', this)"
                >Data Kepegawaian</a
              >
            </li>
            <li>
              <a
                href="#"
                onclick="loadKepegawaianContent('pegawai-terbaik', this)"
                >Pegawai Terbaik</a
              >
            </li>
          </ul>
        </aside>

        
        <main class="kepegawaian-content" id="dynamic-content">
          <div class="loader" id="loader" style="display: none">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
          </div>
        </main>
      </div>
    </div>
<?= $this->endSection() ?> 