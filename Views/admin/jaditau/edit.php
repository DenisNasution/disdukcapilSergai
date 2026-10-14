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
        <?php /** @var array $jaditau */ ?>
        <form action="<?= base_url('admin/jaditau/update/' . $jaditau['jadiTau_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="jadiTau_name">Periode</label>
                <input type="text" class="form-control" name="jadiTau_name" id="jadiTau_name" value="<?= old('jadiTau_name', $jaditau['jadiTau_name']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="jadiTau_desc"><strong>Deskripsi / Konten</strong></label>
                <textarea 
                    name="jadiTau_desc" 
                    id="jadiTau_desc" 
                    class="form-control" 
                    rows="10"
                ><?= old('jadiTau_desc') ?><?= old('jadiTau_desc', $jaditau['jadiTau_desc'] ?? '') ?></textarea>
                <small class="text-muted">
                    Gunakan toolbar di atas untuk menformat teks (bold, list, link, dll).
                </small>
            </div>
            <div class="form-group">
                <label>Gambar Saat Ini</label><br>
                <img src="<?= base_url('uploads/images/jadiTau/' . $jaditau['jadiTau_img'] ) ?>" width="320" height="220" style="object-fit: contain;">                
            </div>

            <div class="form-group mt-2">
                <label for="jadiTau_img">Ganti Gambar (Opsional)</label>
                <input type="file" class="form-control" name="jadiTau_img" id="jadiTau_img" accept="image/*" onchange="previewImage(event)">
            </div>
            <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                <img id="imagePreview" src="#" alt="Preview" style="width: 320px; height: 220px; object-fit: contain; border-radius: 8px; border: 1px solid #ddd;">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/jaditau') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>