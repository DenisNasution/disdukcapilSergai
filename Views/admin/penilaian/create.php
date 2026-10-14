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
        <form action="<?= base_url('admin/penilaian/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php /** @var int $penilaian_id */ ?>
            <input type="hidden" name="penilaian_id" value="<?= ($penilaian_id) ?>">
            <div class="form-group ">
                <label for="kategori_id">Kategori</label>
                <select class="form-control" disabled>
                    <option value="">-- Pilih Kategori --</option>
                    <?php if (!empty($penilaian)): ?>
                        <?php foreach ($penilaian as $nilai): ?>
                            <option value="<?= esc($nilai['penilaian_id']) ?>" <?= $penilaian_id == $nilai['penilaian_id'] ? 'selected' : '' ?> >
                                <?= esc($nilai['penilaian_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="penilaian_list_img">Gambar</label>
                <input type="file" class="form-control" name="penilaian_list_img" id="penilaian_list_img" accept="image/*" required onchange="previewImage(event)">
                
                <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                    <img id="imagePreview" src="#" alt="Preview" style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/penilaian') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>