<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<div class="qna-tabs">
    <?php /** @var string $activeStatus */ ?>
    <a href="<?= base_url('admin/beranda/1/slider') ?>" 
       class="qna-tab <?= $activeStatus === 'slider' ? 'active' : '' ?>">
        <i class="fas fa-images"></i> Slider
    </a>
    <a href="<?= base_url('admin/beranda/2/gallery') ?>" 
       class="qna-tab <?= $activeStatus === 'gallery' ? 'active' : '' ?>">
        <i class="fas fa-images"></i> Gallery
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
            <tr><?php /** @var int $kat_id */ ?>
                <th style="width: 50px;">No</th>
                <th style="width:350px;">Gambar</th>
                <?php if ($kat_id == 2): ?>
                <th>Judul</th>
                <th>Tanggal</th>
                <?php endif; ?> 
                <th style="width: 100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($beranda)): ?>
                <?php $no = 1; // Start from 1 ?>
                <?php foreach ($beranda as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?php /** @var string $folder */ ?>
                            <img src="<?= base_url('uploads/images/beranda/'.$folder.'/'. $item['beranda_img']) ?>" alt="Gambar" >
                        </td>
                        <?php if ($item['beranda_kat_id'] == 2): ?>
                            <td><?= $item['beranda_desc'] ?></td>
                            <td><?= esc($item['beranda_date']) ?></td>
                        <?php endif; ?>                        
                        <td style="min-width: 20px !important;">
                            <a href="<?= base_url('admin/beranda/edit/' . $item['beranda_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
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