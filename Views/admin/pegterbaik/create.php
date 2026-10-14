<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

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
        <form action="<?= base_url('admin/pegterbaik/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>    
            <div class="form-group mb-3">
                <label for="pegawai_terbaik_name">Nama Pegawai</label>
                <input type="text" class="form-control" name="pegawai_terbaik_name" id="pegawai_terbaik_name" required>
            </div>
            <div class="form-group mb-3">
                <label for="pegawai_terbaik_date">Periode</label>
                <input type="text" class="form-control" name="pegawai_terbaik_date" id="pegawai_terbaik_date" required>
            </div>

            <div class="form-group mb-3">
                <label for="pegawai_terbaik_img">Gambar</label>
                <input type="file" class="form-control" name="pegawai_terbaik_img" id="pegawai_terbaik_img" accept="image/*" required onchange="previewImage(event)">
                
                <!-- Live Preview Container -->
                <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                    <img id="imagePreview" src="#" alt="Preview" style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin/pegterbaik') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>