<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div style="overflow-x: auto;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th style="width: 20px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datapenduduk)): ?>
                <?php $no = 1; ?>
                <?php foreach ($datapenduduk as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['data_penduduk_name'] ?></td>
                        <td><?= number_format($item['data_penduduk_jmlh'], 0, ',', '.') ?></td>
                        <td style=" min-width: 20px !important;">
                            <a href="<?= base_url('admin/datapend/edit/' . $item['data_penduduk_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data Penduduk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>