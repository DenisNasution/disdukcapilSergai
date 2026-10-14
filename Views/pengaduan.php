
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

   
    <div class="container main-content">
      
      <div class="page-banner">
        <h1>Pengaduan Masyarakat</h1>
        <p>Mekanisme dan Sarana Penyampaian Pengaduan</p>
      </div>

      
      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> /
        <span id="breadcrumb-title">Pengaduan</span>
      </div>

      
      <div class="pengaduan-grid">
        <script>
            window.pengaduanDataFromPHP = <?= json_encode($pengaduanData ?? []) ?>;
        </script>
        
        <aside class="pengaduan-sidebar">
          <h3>Menu Pengaduan</h3>
          <ul class="sidebar-menu">
            <li>
              <a
                href="#"
                onclick="loadPengaduanContent('alur', this)"
                class="active"
                >Alur Pengaduan</a
              >
            </li>
            <li>
              <a href="#" onclick="loadPengaduanContent('sarana', this)"
                >Sarana & Prasarana</a
              >
            </li>
            <li>
              <a href="#" onclick="loadPengaduanContent('waktu', this)"
                >Jangka Waktu Penyelesaian</a
              >
            </li>
            <li>
              <a href="#" onclick="loadPengaduanContent('rekapitulasi', this)"
                >Rekapitulasi Pengaduan</a
              >
            </li>
        </aside>
        
        <main class="pengaduan-content" id="dynamic-content">
          <div class="loader" id="loader" style="display: none">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
          </div>
        </main>
      </div>
    </div>
<?= $this->endSection() ?>
