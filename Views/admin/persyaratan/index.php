<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/persyaratan/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah persyaratan
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
                <th style="width:350px;">Gambar</th>
                <th >Jenis Persyaratan</th>

                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($persyaratan)): ?>
                <?php /** @var object $pager */ ?>
                <?php 
                $details = $pager->getDetails('default'); 
                $perPage = $details['perPage'];
                $currentPage = $details['currentPage'];
                
                $no = ($currentPage - 1) * $perPage + 1;
                ?>
                <?php foreach ($persyaratan as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/images/syarat/' . $item['persyaratan_img'])?>" alt="Gambar">
                        </td>
                        <td><?= esc($item['persyaratan_name']) ?></td>
                        
                        <td>
                            <?php /** @var object $pager */ ?>
                            <?php 
                                
                                $details = $pager->getDetails('default');
                                $currentPage = $details['currentPage'];
                            ?>
                            <a href="<?= base_url('admin/persyaratan/edit/' . $item['persyaratan_id']. '?page=' . $currentPage) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/persyaratan/delete/' . $item['persyaratan_id']. '?page=' . $currentPage) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
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
</div>

<?php /** @var object $pager */ ?>

<div class="pagination-wrapper">
    <?= $pager->links('default', 'admin_pager') ?>
</div>

<?= $this->endSection() ?>