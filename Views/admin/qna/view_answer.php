<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>

<h3>Detail Jawaban</h3>

<a href="<?= base_url('admin/qna/answered') ?>" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card mb-3">
    <div class="card-body">
        <div class="qna-info-header">
            <div class="qna-info-avatar">
                <i class="fas fa-user"></i>
            </div>
            <?php /** @var object $qna */ ?>
            <div class="qna-info-details">
                <h4><?= esc($qna['qna_name']) ?></h4>
                <div class="qna-info-meta">
                    <span><i class="fas fa-id-card"></i> NIK: <?= esc($qna['qna_id_number']) ?></span>
                    <span><i class="fas fa-clock"></i> <?= date('d M Y, H:i', strtotime($qna['qna_created_at'])) ?></span>
                </div>
            </div>
        </div>

        <hr class="qna-divider">
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
        <div class="qna-section-block">
            <div class="qna-section-label success">
                <i class="fas fa-reply"></i> Jawaban Petugas
            </div>
            <div class="answer-box">
                <?= nl2br(esc($qna['qna_answer'])) ?>
            </div>
            <div class="qna-answered-time">
                <i class="fas fa-check-circle"></i> Dijawab pada: 
                <?= date('d M Y, H:i', strtotime($qna['qna_answered_at'])) ?>
            </div>
        </div>

    </div>
</div>

<a href="<?= base_url('admin/qna/detail/' . $qna['qna_id']) ?>" class="btn btn-warning">
    <i class="fas fa-edit"></i> Edit Jawaban
</a>
<?php if (is_superadmin()): ?>
    <a href="<?= base_url('admin/qna/delete/' . $qna['qna_id']) ?>" 
    class="btn btn-danger"
    onclick="return confirm('Yakin ingin menghapus?')">
        <i class="fas fa-trash"></i> Hapus
    </a>
<?php endif; ?>

<style>
.answer-box {
    background: #eef7ee;
    border-left: 4px solid #4a7c44;
    padding: 15px;
    border-radius: 8px;
    color: #333;
    line-height: 1.7;
}
</style>

<?= $this->endSection() ?>