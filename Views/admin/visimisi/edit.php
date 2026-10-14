<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>
<script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name="visimisi_desc"]',
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

<div class="card">
    <div class="card-body">
         <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php /** @var array $visimisi */ ?>
        <form action="<?= base_url('admin/visimisi/update/' . $visimisi['visimisi_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="visimisi_desc"><strong>Visi</strong></label>
                <textarea 
                    name="visimisi_desc" 
                    id="visimisi_desc" 
                    class="form-control" 
                    rows="10"
                ><?= old('visimisi_desc') ?><?= old('visimisi_desc', $visimisi['visimisi_desc'] ?? '') ?></textarea>
                <small class="text-muted">
                    Gunakan toolbar di atas untuk menformat teks (bold, list, link, dll).
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/visimisi') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>