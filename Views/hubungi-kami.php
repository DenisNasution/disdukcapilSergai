<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

   
    
    <div class="container main-content">
      <div class="page-banner">
        <h1><i class="fas fa-headset"></i> Hubungi Kami</h1>
        <p>Kami Siap Membantu Anda</p>
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> / <span>Hubungi Kami</span>
      </div>

      <div class="page-intro">
        <h3><i class="fas fa-comments"></i> Silakan Hubungi Kami</h3>
        <p>
          Jika Anda memiliki pertanyaan, keluhan, atau membutuhkan informasi
          lebih lanjut mengenai pelayanan administrasi kependudukan, jangan ragu
          untuk menghubungi kami melalui salah satu kanal berikut.
        </p>
      </div>

      <div class="contact-grid">
        <div class="contact-card">
          <div class="icon-circle card-wa">
            <i class="fab fa-whatsapp"></i>
          </div>
          <h3>WhatsApp</h3>
          <p>
            Chat langsung dengan petugas kami untuk pertanyaan cepat seputar
            pelayanan dan persyaratan dokumen.
          </p>
          <a
            href="https://wa.me/628116301218"
            target="_blank"
            class="action-btn btn-wa"
          >
            <i class="fab fa-whatsapp"></i> Chat Sekarang
          </a>
        </div>

        <div class="contact-card">
          <div class="icon-circle card-email">
            <i class="fas fa-envelope"></i>
          </div>
          <h3>Email</h3>
          <p>
            Kirimkan pertanyaan, saran, atau pengaduan secara tertulis. Kami
            akan merespon melalui email yang sama.
          </p>
          <a
            href="mailto:disdukcapilkabsergai1218@gmail.com"
            class="action-btn btn-email"
          >
            <i class="fas fa-envelope"></i> Kirim Email
          </a>
        </div>

        <div class="contact-card">
          <div class="icon-circle card-address">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <h3>Alamat Kantor</h3>
          <p>
            Jl. Medan-Tebing Tinggi Km. 42<br />
            (Komplek Replika Istana Sultan Serdang)<br />
            Kelurahan Tualang, Kecamatan Perbaungan<br />
            Kabupaten Serdang Bedagai<br />
            Provinsi Sumatera Utara, 20986
          </p>
          <a
            href="https://www.google.com/maps/place/Replika+ISTANA+SULTAN+SERDANG/@3.5668668,98.9838475,17z/data=!3m1!4b1!4m6!3m5!1s0x30314fba72af8cbd:0xa3b33e6511d5fb86!8m2!3d3.5668668!4d98.9838475!16s%2Fg%2F11cjpprx4y?entry=ttu"
            target="_blank"
            class="action-btn btn-address"
          >
            <i class="fas fa-map-marker-alt"></i> Lihat Peta
          </a>
        </div>
      </div>
    </div>


<?= $this->endSection() ?>
