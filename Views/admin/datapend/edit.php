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
        <?php /** @var array $datapenduduk */ ?>
        <form action="<?= base_url('admin/datapend/update/' . $datapenduduk['data_penduduk_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="data_penduduk_name">Ketegori</label>
                <input type="text" class="form-control" name="data_penduduk_name" id="data_penduduk_name" value="<?= old('data_penduduk_name', $datapenduduk['data_penduduk_name']) ?>" disabled>
            </div>
            <div class="form-group">
                <label for="data_penduduk_jmlh">Jumlah Pegawai</label>
                <input type="number" class="form-control" name="data_penduduk_jmlh" id="data_penduduk_jmlh" value="<?= old('data_penduduk_jmlh', $datapenduduk['data_penduduk_jmlh']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/datapend') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>