<?= $this->extend('layouts/admin_main') ?>

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
        <?php /** @var array $beranda */ ?>
        <form action="<?= base_url('admin/beranda/update/' . $beranda['beranda_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php if ($beranda['beranda_kat_id'] == 2): ?>
            <div class="form-group">
                <label for="beranda_desc">Judul</label>
                <input type="text" class="form-control" name="beranda_desc" id="beranda_desc" value="<?= esc(old('beranda_desc', $beranda['beranda_desc'])) ?>" required>
            </div>

            <div class="form-group">
                <label for="beranda_date">Tanggal</label>
                <input type="text" class="form-control" name="beranda_date" id="beranda_date" value="<?= old('beranda_date', $beranda['beranda_date']) ?>" required>
            </div>
            <?php endif; ?> 
            <div class="form-group">
                <label>Gambar Saat Ini</label><br>
                <?php /** @var string $folder */ ?>
                <img src="<?= base_url('uploads/images/beranda/'. $folder. '/' . $beranda['beranda_img'] ) ?>" width="320" height="220" style="object-fit: contain;">                
            </div>

            <div class="form-group mt-2">
                <label for="beranda_img">Ganti Gambar (Opsional)</label>
                <input type="file" class="form-control" name="beranda_img" id="beranda_img" accept="image/*" onchange="previewImage(event)">
            </div>
            <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                <img id="imagePreview" src="#" alt="Preview" style="width: 320px; height: 220px; object-fit: contain; border-radius: 8px; border: 1px solid #ddd;">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/kepuasan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>