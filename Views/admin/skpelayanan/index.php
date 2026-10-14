<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>
<div class="qna-tabs">
    <a href="<?= base_url('admin/peruu') ?>" 
       class="qna-tab">
        <i class="fas fa-file-contract"></i> Perundang - Undangan
    </a>
    <a href="<?= base_url('admin/skpelayanan') ?>" 
       class="qna-tab active">
        <i class="fas fa-file-contract"></i> SK Pelayanan
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/skpelayanan/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah SK Pelayanan
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th>File PDF</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($peraturan)): ?>
            <?php /** @var object $pager */ ?>
            <?php 
        
        $details = $pager->getDetails('default'); 
        $perPage = $details['perPage'];
        $currentPage = $details['currentPage'];
        $no = ($currentPage - 1) * $perPage + 1;
            ?>
            <?php foreach ($peraturan as $item): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <a href="<?= base_url('uploads/images/peraturan/SKPelayanan/' . $item['sk_pelayanan_file']) ?>" target="_blank" class="btn btn-sm btn-info">
                        <i class="fas fa-file-pdf"></i> <?= esc($item['sk_pelayanan_name']) ?>
                    </a>
                </td>
                <td>
                    <?php /** @var object $pager */ ?>
        <?php 
            $details = $pager->getDetails('default');
            $currentPage = $details['currentPage'];
        ?>
                    <a href="<?= base_url('admin/skpelayanan/edit/' . $item['sk_pelayanan_id']) ?>?page=<?= $currentPage ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Edit</a>
                    <a href="<?= base_url('admin/skpelayanan/delete/' . $item['sk_pelayanan_id']) ?>?page=<?= $currentPage ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i>Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data persyaratan.</td>
                </tr>
            <?php endif; ?>
    </tbody>
</table>
<?php /** @var object $pager */ ?>
<div class="pagination-wrapper">
    <?= $pager->links('default', 'admin_pager') ?>
</div>

<?= $this->endSection() ?>