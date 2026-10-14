<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
      <div class="page-banner">
        <h1>Penilaian Kinerja</h1>
        <p>Evaluasi Penyelenggaraan Pelayanan Publik & Akuntabilitas</p>
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> / <span>Penilaian Kinerja</span>
      </div>

      <div class="page-intro">
        <h3>
          <i
            class="fas fa-clipboard-check"
            style="
              color: linear-gradient(
                135deg,
                var(--primary-green),
                var(--dark-green)
              );
            "
          ></i>
          Laporan Evaluasi & Penilaian
        </h3>
        <p>
          Berikut adalah daftar dokumen penilaian kinerja dari berbagai lembaga
          pengawas dan evaluator eksternal. Klik pada setiap item untuk melihat
          dokumen lengkapnya.
        </p>
      </div>

      <div class="penilaian-list">
        <?php if (!empty($penilaian) && is_array($penilaian)): ?>
            <?php foreach ($penilaian as $item): ?>
        <div
          class="penilaian-item"
          onclick="window.location.href = '<?= base_url('penilaian_detail/' . $item['penilaian_id']) ?>'"
        >
          <div class="icon-wrapper inst-kemendagri">
            <i class="fas fa-university"></i>
          </div>
          <div class="item-content">
            <div class="item-title"><?= esc($item['penilaian_id']) ?>. <?= esc($item['penilaian_name']) ?></div>
          </div>
          <div class="action-icon"><i class="fas fa-arrow-right"></i></div>
        </div>
               <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Penilaian yang ditemukan.</p>
        <?php endif; ?>
      </div>
    </div>

<?= $this->endSection() ?>
