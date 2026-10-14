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
        <form action="<?= base_url('admin/skpelayanan/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div>
                <label for="sk_pelayanan_name">Nama SK Pelayanan</label>
                <input type="text" class="form-control" name="sk_pelayanan_name" id="sk_pelayanan_name" required>
            </div>
            <div class="form-group">
                <label for="sk_pelayanan_file">File</label>
                <input type="file" name="sk_pelayanan_file" class="form-control" accept="application/pdf" required>
                
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/skpelayanan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>