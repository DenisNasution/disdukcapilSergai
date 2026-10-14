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
        <?php /** @var array $datapegawai */ ?>
        <form action="<?= base_url('admin/datapeg/update/' . $datapegawai[0]['data_pegawai_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="data_pegawai_jumlah">Jumlah Pegawai</label>
                <input type="number" class="form-control" name="data_pegawai_jumlah" id="data_pegawai_jumlah" value="<?= old('data_pegawai_jumlah', $datapegawai[0]['data_pegawai_jumlah']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/datapeg') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>