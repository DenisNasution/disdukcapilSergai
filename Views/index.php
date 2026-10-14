
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="container main-content">
            <div class="announcement-grid">
                <div class="carousel-wrapper">
          <div class="carousel-container" id="carousel">            
             <?php if (!empty($carrousel) && is_array($carrousel)): ?>
            <?php foreach ($carrousel as $item): ?>
            <div class="carousel-slide">
              <img
                src="<?=  base_url('uploads/images/beranda/carrousel/'. $item[ 'beranda_img'])?>"
                alt="<?= esc($item['beranda_img']) ?>"
              />
                          </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada data Kepuasan Masyarakat yang ditemukan.</p>
        <?php endif; ?>

                        <button class="carousel-btn prev-btn" onclick="changeSlide(-1)">
              &#10094;
            </button>
            <button class="carousel-btn next-btn" onclick="changeSlide(1)">
              &#10095;
            </button>
          </div>

                    <div class="carousel-dots">
            <span class="dot active" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
          </div>
        </div>
              </div>

            <div class="stats-row">
        <div class="stat-card">
          <div class="icon-circle"><i class="fas fa-user-check"></i></div>
          <div class="number" data-target="57">0</div>
          <div style="font-size: 1.5rem; color: #666">Jumlah Pelayanan</div>
        </div>
        <div class="stat-card">
          <div class="icon-circle"><i class="fas fa-id-card"></i></div>
          <div class="number" data-target="185.939">0</div>
          <div style="font-size: 1.5rem; color: #666">Jumlah KTP</div>
        </div>
        <div class="stat-card">
          <div class="icon-circle"><i class="fas fa-file-alt"></i></div>
          <div class="number" data-target="226.181">0</div>
          <div style="font-size: 1.5rem; color: #666">Jumlah KK</div>
        </div>
      </div>

            <div class="service-strip">
        <div
          class="service-btn"
          style="
            padding: 0;
            background-color: transparent;
            color: var(--primary-green);
            cursor: not-allowed;
          "
        >
          <i class="fas fa-server"></i> PELAYANAN
        </div>
        <div class="service-btn">
          <a href="<?= base_url('persyaratan') ?>">
            <i class="fas fa-file-signature"></i> Persyaratan Pelayanan
          </a>
        </div>
        <div class="service-btn">
          <a href="<?= base_url('kependudukan') ?>">
            <i class="fas fa-chart-line"></i> Data Kependudukan
          </a>
        </div>
        <div class="service-btn">
          <a href="<?= base_url('kepuasanMasyarakat') ?>">
            <i class="fas fa-chart-line"></i> Kepuasan
          </a>
        </div>
        <div class="service-btn">
          <a href="<?= base_url('penghargaan') ?>">
            <i class="fa-solid fa-award"></i> Penghargaan
          </a>
        </div>
        <div class="service-btn">
          <a href="<?= base_url('penilaian') ?>">
            <i class="fa-solid fa-star"></i> Penilaian
          </a>
        </div>
        <div class="service-btn">
          <a href="<?= base_url('jadiTau') ?>">
            <i class="fa-solid fa-lightbulb"></i> JADI TAU
          </a>
        </div>
      </div>

            <h2 class="section-title">
        <i class="fas fa-chart-simple"></i> Statistik Pengunjung
      </h2>
      <div class="visitor-stats">
        <div class="stat-item">
          <span class="num">128</span><span class="label">Hari Ini</span>
        </div>
        <div class="stat-item">
          <span class="num">1,102</span><span class="label">Minggu Ini</span>
        </div>
        <div class="stat-item">
          <span class="num">247,154</span><span class="label">Bulan Ini</span>
        </div>
        <div class="stat-item">
          <span class="num">248,364</span><span class="label">Total</span>
        </div>
      </div>
                  <section class="gallery-section">
        <h2 class="section-title">
          <i class="fas fa-images"></i> Galeri Kegiatan
        </h2>
        <div class="gallery-grid">
                     <?php if (!empty($gallery) && is_array($gallery)): ?>
            <?php foreach ($gallery as $gall): ?>
          <div class="gallery-card">
            <div class="gallery-img">
              <img
                src="<?=  base_url('uploads/images/beranda/galeri/'. $gall[ 'beranda_img']) ?>"
                alt="Kegiatan 1"
              />
            </div>
            <div class="gallery-info">
              <h4>
                <?= esc($gall['beranda_desc']) ?>
              </h4>
              <span class="gallery-date"><?= esc($gall['beranda_date']) ?></span>
            </div>
          </div>
           <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Belum ada Gallery yang bisa ditampilkan.</p>
        <?php endif; ?>
        </div>
      </section>
                  <h2 class="section-title"><i class="fas fa-phone"></i>Kontak</h2>
      <div class="contact-links">
                <a
          href="https://wa.me/628116301218"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-whatsapp social-icon whatsapp"></i>
          <span>WhatsApp</span>
          <span>08116301218</span>
        </a>

                <a
          href="mailto:disdukcapilkabsergai1218@gmail.com"
          target="_blank"
          class="social-item"
        >
          <i class="fas fa-envelope social-icon email"></i>
          <span>Email</span>
        </a>
      </div>
      <h2 class="section-title">
        <i class="fa-solid fa-share-nodes"></i> Social Media
      </h2>
      <div class="social-links">
                <a
          href="https://www.instagram.com/disdukcapil_sergai1218?utm_source=qr&igsh=MmVrcTl6eHd2MjE4"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-instagram social-icon instagram"></i>
          <span>Instagram</span>
        </a>

                <a
          href="https://www.facebook.com/share/1CrM3Vc5pW/"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-facebook-f social-icon facebook"></i>
          <span>Facebook</span>
        </a>

                <a
          href="https://www.threads.com/@disdukcapil_sergai1218"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-threads social-icon threads"></i>
          <span>Threads</span>
        </a>

                <a
          href="https://www.tiktok.com/@disdukcapil.sergai?_r=1&_t=ZS-98qTkDM4YrM"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-tiktok social-icon tiktok"></i>
          <span>TikTok</span>
        </a>

                <a
          href="https://sck.io/u/@disdukcapilser507/AAIttd1h"
          target="_blank"
          class="social-item"
        >
          <i class="fas fa-video social-icon snackvideo"></i>
          <span>Snack Video</span>
        </a>

                <a
          href="https://x.com/Capilsergai2024"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-x-twitter social-icon x-twitter"></i>
          <span>X</span>
        </a>

                <a
          href="https://youtube.com/@disdukcapilserdangbedaga-yy6cv?si=-Lx_q9-dFRs6A4Fm"
          target="_blank"
          class="social-item"
        >
          <i class="fab fa-youtube social-icon youtube"></i>
          <span>YouTube</span>
        </a>
      </div>
    </div>
    <h2 class="section-title" style="margin-top: 20px">
      <i class="fas fa-link"></i> Link Terkait
    </h2>
    <div class="gov-links">
            <a href="https://prod.lapor.go.id/" target="_blank" class="gov-item">
        <div class="gov-icon-wrapper">
          <i class="fas fa-bullhorn"></i>
        </div>
        <div class="gov-info">
          <span class="gov-name">LAPOR!</span>
          <span class="gov-desc">Pengaduan Nasional</span>
        </div>
        <div class="gov-badge">Resmi</div>
      </a>

            <a
        href="https://ppid.serdangbedagaikab.go.id/"
        target="_blank"
        class="gov-item"
      >
        <div class="gov-icon-wrapper">
          <i class="fas fa-folder-open"></i>
        </div>
        <div class="gov-info">
          <span class="gov-name">PPID</span>
          <span class="gov-desc">Serdang Bedagai</span>
        </div>
        <div class="gov-badge">Resmi</div>
      </a>

            <a href="https://sippn.menpan.go.id/" target="_blank" class="gov-item">
        <div class="gov-icon-wrapper">
          <i class="fas fa-star"></i>
        </div>
        <div class="gov-info">
          <span class="gov-name">SIPPN</span>
          <span class="gov-desc">KemenPAN-RB</span>
        </div>
        <div class="gov-badge">Resmi</div>
      </a>

            <a href="https://skm.go.id/" target="_blank" class="gov-item">
        <div class="gov-icon-wrapper">
          <i class="fas fa-clipboard-check"></i>
        </div>
        <div class="gov-info">
          <span class="gov-name">SKM</span>
          <span class="gov-desc">Survei Kepuasan Masyarakat</span>
        </div>
        <div class="gov-badge">Resmi</div>
      </a>
    </div>

    <?= $this->endSection() ?>