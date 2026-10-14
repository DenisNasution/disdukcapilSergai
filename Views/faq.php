<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>   

    <div class="container main-content">
      <div class="page-banner">
        <h1><i class="fas fa-question-circle"></i> FAQ</h1>
        <p>Pertanyaan yang Sering Diajukan Seputar Pelayanan Adminduk</p>
      </div>

      <div class="breadcrumbs">
        <a href="<?= base_url('index') ?>">Beranda</a> / <span>FAQ</span>
      </div>

      <div class="page-intro">
        <h3>
          <i class="fas fa-comments" style="color: var(--primary-green)"></i>
          Temukan Jawaban Anda Di Sini
        </h3>
        <p>
          Berikut adalah kumpulan pertanyaan yang sering ditanyakan oleh
          masyarakat. Jika Anda tidak menemukan jawaban yang Anda cari, silakan
          hubungi kami melalui kontak yang tersedia.
        </p>
      </div>

      <div class="faq-container">
        <?php if (!empty($faq)): ?>
                <?php foreach ($faq as $item): ?>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            <h4><?= esc($item['faq_question']) ?></h4>
            <i class="fas fa-chevron-down faq-icon"></i>
          </div>
          <div class="faq-answer">
            <?=$item['faq_answer']?>
          </div>
        </div>
        <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada pertanyaan yang dijawab.</p>
            <?php endif; ?>
      </div>
    </div>

   
    <?= $this->endSection() ?>