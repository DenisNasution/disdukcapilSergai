<?= $this->extend('/layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

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
        <form action="<?= base_url('admin/persyaratan/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="persyaratan_name">Jenis Persyaratan</label>
                <input type="text" class="form-control" name="persyaratan_name" id="persyaratan_name" required>
            </div>
            <div class="form-group">
                <label for="persyaratan_img">Gambar</label>
                <input type="file" class="form-control" name="persyaratan_img" id="persyaratan_img" accept="image/*" required onchange="previewImage(event)">
                
                <!-- Live Preview Container -->
                <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                    <img id="imagePreview" src="#" alt="Preview" style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/persyaratan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>