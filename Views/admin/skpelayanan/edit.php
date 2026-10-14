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
        <?php /** @var array $peraturan */ ?>
        <form action="<?= base_url('admin/skpelayanan/update/' . $peraturan['sk_pelayanan_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php /** @var string $currentPage */ ?>
            <input type="hidden" name="page" value="<?= esc($currentPage) ?>">            
            <div class="form-group">
                <label for="sk_pelayanan_name">Judul</label>
                <input type="text" class="form-control" name="sk_pelayanan_name" id="sk_pelayanan_name" value="<?= old('sk_pelayanan_name', $peraturan['sk_pelayanan_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>File Saat Ini</label><br>
                <a href="<?= base_url('uploads/images/peraturan/SKPelayanan/' . $peraturan['sk_pelayanan_file']) ?>" target="_blank" class="btn btn-sm btn-info">
                        <i class="fas fa-file-pdf"></i> <?= esc($peraturan['sk_pelayanan_name']) ?>
                    </a>
            </div>
            <div class="form-group">
                <label for="sk_pelayanan_file">File</label>
                <input type="file" name="sk_pelayanan_file" class="form-control" accept="application/pdf">
                
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/skpelayanan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>