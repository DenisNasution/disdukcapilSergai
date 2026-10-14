<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

     <div class="container main-content">
      <div class="page-banner">
        <h1>Profil Dinas</h1>
        <p>Dinas Kependudukan dan Pencatatan Sipil</p>
      </div>
      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> /
        <span id="breadcrumb-title">Profil</span>
      </div>
      <div class="profile-grid">
        <script>
            window.profileDataFromPHP = <?= json_encode($profile ?? []) ?>;
        </script>
        <aside class="profile-sidebar">
          <h3>Menu Profil</h3>
          <ul class="sidebar-menu">
            <li>
              <a href="#" onclick="loadProfileContent('visi-misi', this)"
                >Visi dan Misi</a
              >
            </li>
            <li>
              <a href="#" onclick="loadProfileContent('moto', this)">Moto</a>
            </li>
            <li>
              <a href="#" onclick="loadProfileContent('maklumat', this)"
                >Maklumat Pelayanan</a
              >
            </li>
          </ul>
        </aside>

        <main class="profile-content" id="dynamic-content">
          <div
            class="loader"
            id="loader"
            style="display: none; text-align: center; padding: 20px"
          >
            <i
              class="fas fa-spinner fa-spin fa-2x"
              style="color: var(--primary-green)"
            ></i>
          </div>
        </main>
      </div>
    </div>

    <?= $this->endSection() ?>