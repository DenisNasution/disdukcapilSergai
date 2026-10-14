<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>

<h3>Detail Penolakan</h3>

<a href="<?= base_url('admin/qna/rejected') ?>" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<div class="card mb-3">
    <div class="card-body">
        <div class="qna-info-header">
            <div class="qna-info-avatar">
                <i class="fas fa-user"></i>
            </div>
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
            <div class="qna-section-label danger">
                <i class="fas fa-ban"></i> Alasan Penolakan Petugas
            </div>
            <div class="reject-box">
                <?= nl2br(esc($qna['qna_reject_reason'])) ?>
            </div>            
        </div>
    </div>
</div>
<?php if (is_superadmin()): ?>
    <a href="<?= base_url('admin/qna/delete/' . $qna['qna_id']) ?>" 
    class="btn btn-danger"
    onclick="return confirm('Yakin ingin menghapus?')">
        <i class="fas fa-trash"></i> Hapus
    </a>
<?php endif; ?>


<?= $this->endSection() ?>