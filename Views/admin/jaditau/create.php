<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name="jadiTau_desc"]',
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
    <h3>Tambah Jadi Tau Adminduk</h3>
    <a href="<?= base_url('admin/jaditau') ?>" class="btn btn-secondary">
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
        <form action="<?= base_url('admin/jaditau/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="jadiTau_name"><strong> Judul</strong></label>
                <input 
                    type="text" 
                    name="jadiTau_name" 
                    id="jadiTau_name"
                    class="form-control" 
                    value="<?= old('jadiTau_name') ?>" 
                    placeholder="Contoh: Jam Kerja Pelayanan"
                    required
                >
                <small class="text-muted">Masukkan judul singkat untuk item ini.</small>
            </div>

            <div class="form-group mb-3">
                <label for="jadiTau_desc"><strong>Keterangan</strong></label>
                <textarea 
                    name="jadiTau_desc" 
                    id="jadiTau_desc" 
                    class="form-control" 
                    rows="10"
                ><?= old('jadiTau_desc') ?></textarea>
                <small class="text-muted">
                    Gunakan toolbar di atas untuk menformat teks (bold, list, link, dll).
                </small>
            </div>

            <div class="form-group mb-3">
                <label for="jadiTau_img"><strong>Gambar</strong></label>
                <input 
                    type="file" 
                    name="jadiTau_img" 
                    id="jadiTau_img"
                    class="form-control" 
                    accept="image/*" 
                    required 
                    onchange="previewImage(event)"
                >
                <small class="text-muted">Format: JPG, PNG, WebP. Maksimal 2 MB.</small>

                <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 250px; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin/jaditau') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>