<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name="faq_answer"]',
        height: 400,
        menubar: false,
        plugins: 'lists link code table',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | code | removeformat',
        license_key: 'gpl',
        branding: false,
        promotion: false,
        forced_root_block: false,
        force_br_newlines: true,
        force_p_newlines: false
    });
</script>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Tambah FAQ</h3>
    <a href="<?= base_url('admin/faq') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('admin/faq/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="faq_question"><strong>Pertanyaan</strong></label>
                <input 
                    type="text" 
                    name="faq_question" 
                    id="faq_question"
                    class="form-control" 
                    required
                >
            </div>

            <div class="form-group mb-3">
                <label for="faq_answer"><strong>Keterangan</strong></label>
                <textarea 
                    name="faq_answer" 
                    id="faq_answer" 
                    class="form-control" 
                    rows="10"
                ></textarea>
                <small class="text-muted">
                    Gunakan toolbar di atas untuk menformat teks (bold, list, link, dll).
                </small>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin/faq') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>