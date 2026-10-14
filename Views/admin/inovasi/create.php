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
        <form action="<?= base_url('admin/inovasi/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group ">
                <?php /** @var string $inovasi_id */ ?>
                <input type="hidden" name="inovasi_id" value="<?= esc($inovasi_id) ?>">
                <label for="inovasi_id">Kategori Inovasi</label>
                <select class="form-control" required disabled>
                    <option value="">-- Pilih Kategori --</option>
                    <?php if (!empty($inovasi)): ?>
                        <?php foreach ($inovasi as $item): ?>
                            <option value="<?= esc($item['inovasi_id']) ?>" <?= $inovasi_id == $item['inovasi_id'] ? 'selected' : '' ?> >
                                <?= esc($item['inovasi_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="inovasi_list_img">Gambar</label>
                <input type="file" class="form-control" name="inovasi_list_img" id="inovasi_list_img" accept="image/*" required onchange="previewImage(event)">
                
                <div id="imagePreviewContainer" style="margin-top: 15px; display: none;">
                    <img id="imagePreview" src="#" alt="Preview" style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/inovasi') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>