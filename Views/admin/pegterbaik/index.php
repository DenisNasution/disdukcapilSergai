<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>
<div class="qna-tabs">
    <a href="<?= base_url('admin/struktur') ?>" 
       class="qna-tab">
        <i class="fas fa-users"></i> Struktur Organisasi
    </a>
    <a href="<?= base_url('admin/datapeg') ?>" 
       class="qna-tab">
        <i class="fas fa-users"></i> Data Pegawai
    </a>
    <a href="<?= base_url('admin/pegterbaik') ?>" 
       class="qna-tab active">
        <i class="fas fa-users"></i> Pegawai Terbaik
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/pegterbaik/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Data Pegawai Terbaik
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
                <th style="width:250px;">Nama Pegawai</th>
                <th style="width:250px;">Bulan</th>
                <th style="width:200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pegterbaik)): ?>
                <?php $no = 1; ?>
                <?php foreach ($pegterbaik as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/images/pegawai/terbaik/' . $item['pegawai_terbaik_img']) ?>" alt="Gambar">
                        </td>
                        <td><?= $item['pegawai_terbaik_name'] ?></td>
                        <td><?= $item['pegawai_terbaik_date'] ?></td>
                        <td >
                            <a href="<?= base_url('admin/pegterbaik/edit/' . $item['pegawai_terbaik_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/pegterbaik/delete/' . $item['pegawai_terbaik_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>