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
                <th style="width:350px;">Gambar</th>
                <th>Judul</th>
                <th style="width: 550px;">Deskripsi</th>
                <th >Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pengaduan)): ?>
                <?php $no = 1; ?>
                <?php foreach ($pengaduan as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/images/pengaduan/' . $item['pengaduan_img']) ?>" alt="Gambar" >
                        </td>
                        <td><?= esc($item['pengaduan_title']) ?></td>
                        <td><?= esc($item['pengaduan_desc']) ?></td>
                        <td style=" min-width: 20px !important;">
                            <a href="<?= base_url('admin/pengaduan/edit/' . $item['pengaduan_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>                           
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>