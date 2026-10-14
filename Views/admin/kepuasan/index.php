<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/kepuasan/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Data Kepuasan Masyarakat
    </a>
</div>

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
                <th style="width:450px;">Gambar</th>
                <th>Periode</th>
                <th style="width: 100px;">Score</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kepuasan)): ?>
                <?php $no = 1; ?>
                <?php foreach ($kepuasan as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/images/kepuasan/' . $item['kepuasan_img']) ?>" alt="Gambar" >
                        </td>
                        <td><?= esc($item['kepuasan_desc']) ?></td>
                        <td><?= esc($item['kepuasan_score']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/kepuasan/edit/' . $item['kepuasan_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/kepuasan/delete/' . $item['kepuasan_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data kepuasan Masyarakat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>