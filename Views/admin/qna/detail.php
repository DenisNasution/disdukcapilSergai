<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>

<h3>Respons Pertanyaan</h3>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <div><?= esc($e) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card mb-3">
    <div class="card-body">
        <div class="qna-detail-header">
            <div class="qna-detail-avatar"><i class="fas fa-user"></i></div>
            <?php /** @var object $qna */ ?>
            <div>
                <h5><?= esc($qna['qna_name']) ?></h5>
                <small>
                    NIK: <?= esc($qna['qna_id_number']) ?> | 
                    <?= date('d M Y H:i', strtotime($qna['qna_created_at'])) ?>
                </small>
            </div>
        </div>
        <hr>
        <div class="qna-section-block">
            <div class="qna-section-label">
                <i class="fas fa-question-circle"></i> Pertanyaan
            </div>
            <div class="qna-question-content">
                <?= nl2br(esc($qna['qna_question'])) ?>
            </div>
            <?php if (!empty($qna['qna_file'])): ?>
                <div class="qna-attachment">
                    <strong><i class="fas fa-paperclip"></i> Lampiran:</strong>
                    <a href="<?= base_url('uploads/qna/' . $qna['qna_file']) ?>" 
                    target="_blank" 
                    class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-file-pdf"></i> Lihat PDF
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="d-flex gap-2 mb-3">
    <button class="btn btn-primary" onclick="showAnswerForm()">
        <i class="fas fa-reply"></i> Jawab
    </button>
    <button class="btn btn-danger" onclick="showRejectModal()">
        <i class="fas fa-ban"></i> Tolak
    </button>
    <a href="<?= base_url('admin/qna') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>


<div id="answerForm" style="display:none;">
    <div class="card">
        <div class="card-body">
            <h5>Jawaban Anda</h5>
            <form action="<?= base_url('admin/qna/submit-answer/' . $qna['qna_id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <textarea name="qna_answer" class="form-control" rows="8" required placeholder="Tulis jawaban Anda di sini..."><?= old('qna_answer', $qna['qna_answer'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Jawaban
                </button>
                <button type="button" class="btn btn-secondary" onclick="hideAnswerForm()">Batal</button>
            </form>
        </div>
    </div>
</div>


<div class="modal-overlay" id="rejectModal" style="display:none;">
    <div class="modal-box">
        <h4><i class="fas fa-ban"></i> Tolak Pertanyaan</h4>
        <p>Masukkan alasan mengapa pertanyaan ini ditolak (contoh: duplikat, tidak sesuai topik, dll).</p>
        <form action="<?= base_url('admin/qna/reject/' . $qna['qna_id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Alasan Penolakan</label>
                <textarea name="qna_reject_reason" class="form-control" rows="4" required placeholder="Contoh: Pertanyaan duplikat dengan ID #12"></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-ban"></i> Tolak Pertanyaan
                </button>
                <button type="button" class="btn btn-secondary" onclick="hideRejectModal()">Batal</button>
            </div>
        </form>
    </div>
</div>


<script>
function showAnswerForm() {
    document.getElementById('answerForm').style.display = 'block';
    document.getElementById('answerForm').scrollIntoView({ behavior: 'smooth' });
}
function hideAnswerForm() {
    document.getElementById('answerForm').style.display = 'none';
}
function showRejectModal() {
    document.getElementById('rejectModal').style.display = 'flex';
}
function hideRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
</script>

<?= $this->endSection() ?>