<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>

<h3>Jawab Pertanyaan</h3>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <div><?= esc($e) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card mb-3">
    <div class="card-body">
        <h5>Pertanyaan dari:</h5>
        <p><strong>Nama:</strong> <?= esc($qna['qna_name']) ?></p>
        <p><strong>NIK:</strong> <?= esc($qna['qna_id_number']) ?></p>
        <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($qna['qna_created_at'])) ?></p>
        <hr>
        <h5>Pertanyaan:</h5>
        <p><?= nl2br(esc($qna['qna_question'])) ?></p>
    </div>
</div>

<form action="<?= base_url('admin/qna/submit-answer/' . $qna['qna_id']) ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label>Jawaban</label>
        <textarea name="qna_answer" class="form-control" rows="8" required><?= old('qna_answer', $qna['qna_answer']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Jawaban</button>
    <a href="<?= base_url('admin/qna') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>