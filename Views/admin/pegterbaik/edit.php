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
        <?php /** @var array $pegterbaik */ ?>
        <form action="<?= base_url('admin/pegterbaik/update/' . $pegterbaik[0]['pegawai_terbaik_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>            
            <div class="form-group">
                <label for="pegawai_terbaik_name">Nama Pegawai</label>
                <input type="text" class="form-control" name="pegawai_terbaik_name" id="pegawai_terbaik_name" value="<?= old('pegawai_terbaik_name', $pegterbaik[0]['pegawai_terbaik_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="pegawai_terbaik_date">Periode</label>
                <input type="text" class="form-control" name="pegawai_terbaik_date" id="pegawai_terbaik_date" value="<?= old('pegawai_terbaik_date', $pegterbaik[0]['pegawai_terbaik_date']) ?>" required>
            </div>
            <div class="form-group">
                <label>Gambar Saat Ini</label><br>
                <img src="<?= base_url('uploads/images/pegawai/terbaik/' . $pegterbaik[0]['pegawai_terbaik_img'] ) ?>" width="320" height="220" style="object-fit: contain;">
                
            </div>

            <div class="form-group mt-2">
                <label for="pegawai_terbaik_img">Ganti Gambar</label>
                <input type="file" class="form-control" name="pegawai_terbaik_img" id="pegawai_terbaik_img" accept="image/*" onchange="previewImage(event)" >
            </div>
            <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                <img id="imagePreview" src="#" alt="Preview" style="width: 320px; height: 220px; object-fit: contain; border-radius: 8px; border: 1px solid #ddd;">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/pegterbaik') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>