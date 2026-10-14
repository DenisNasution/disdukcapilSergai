<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>
<div class="qna-tabs">
    <?php /** @var string $activeStatus */ ?>
    <a href="<?= base_url('admin/inovasi/1/kolaborasi') ?>" 
       class="qna-tab <?= $activeStatus === 'kolaborasi' ? 'active' : '' ?> ">
        <i class="fas fa-lightbulb"></i> Kolaborasi
    </a>
    <a href="<?= base_url('admin/inovasi/2/kinerja') ?>" 
       class="qna-tab <?= $activeStatus === 'kinerja' ? 'active' : '' ?>">
        <i class="fas fa-lightbulb"></i> Pencapaian Target Kinerja
    </a>
    <a href="<?= base_url('admin/inovasi/3/kompetensi') ?>" 
       class="qna-tab <?= $activeStatus === 'kompetensi' ? 'active' : '' ?>">
        <i class="fas fa-lightbulb"></i> Peningkatan Kompetensi Pegawai
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
     <?php /** @var int $inovasi_id */ ?>
    <a href="<?= base_url('admin/inovasi/create/' .  $inovasi_id) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Data Inovasi
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
                <th style="width: 100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($main_item['list_items'])): ?>
                <?php $no = 1; ?>
                <?php foreach ($main_item['list_items'] as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/images/inovasi/' . $item['inovasi_list_img']) ?>" alt="Gambar">
                        </td>
                        <td>
                            <a href="<?= base_url('admin/inovasi/edit/' . $item['inovasi_list_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/inovasi/delete/' . $item['inovasi_list_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data Inovasi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>