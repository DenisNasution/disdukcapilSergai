<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="qna-section">
    <div class="container">
        <div class="qna-banner">
            <h1><i class="fas fa-comments"></i> Tanya Jawab</h1>
            <p>Kirimkan pertanyaan Anda dan lihat jawaban dari petugas kami</p>
        </div>

        <?php 
            $success = session()->getFlashdata('success'); 
            $error = session()->getFlashdata('error'); 
        ?>

        <?php if ($success): ?>
            <div class="alert alert-success" id="flash-alert"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger" id="flash-alert"><?= $error ?></div>
        <?php endif; ?>

        <!-- Add this JavaScript to auto-hide the alert after 4 seconds -->
        <script>
            setTimeout(function() {
                let alertBox = document.getElementById('flash-alert');
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(function() {
                        alertBox.remove();
                    }, 500); // Removes element from DOM after fade out
                }
            }, 4000); // 4000 milliseconds = 4 seconds
        </script>
        <div class="qna-form-card">
            <h2><i class="fas fa-pen"></i> Ajukan Pertanyaan</h2>
            <form action="<?= base_url('tanya-jawab/submit') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="qna_name" class="form-control" value="<?= old('qna_name') ?>" required>
                </div>

                <div class="form-group">
                    <label>NIK / Nomor Identitas</label>
                    <input type="number" name="qna_id_number" class="form-control" value="<?= old('qna_id_number') ?>" required>
                </div>

                <div class="form-group">
                    <label>Pertanyaan</label>
                    <textarea name="qna_question" class="form-control" rows="5" required><?= old('qna_question') ?></textarea>
                </div>
                <div class="form-group">
                <label for="qna_file">Lampiran PDF (Opsional, lampirkan file Pendukung terkait dengan pertanyaan anda)</label>
                <input 
                    type="file" 
                    name="qna_file" 
                    id="qna_file" 
                    class="form-control" 
                    accept="application/pdf"
                >
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim Pertanyaan
                </button>
            </form>
        </div>
        <div class="qna-list">
            <h2><i class="fas fa-list"></i> Pertanyaan yang Sudah Dijawab</h2>

            <?php if (!empty($qna)): ?>
                <?php foreach ($qna as $item): ?>
                    <div class="qna-item">
                        <div class="qna-question">
                            <span class="qna-avatar"><i class="fas fa-user"></i></span>
                            <div>
                                <strong><?= esc($item['qna_name']) ?></strong>
                                <p><?= esc($item['qna_question']) ?></p>
                            </div>
                        </div>
                        <div class="qna-answer">
                            <span class="qna-avatar admin"><i class="fas fa-user-shield"></i></span>
                            <div>
                                <strong>Admin Disdukcapil</strong>
                                <p><?= nl2br(esc($item['qna_answer'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada pertanyaan yang dijawab.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>