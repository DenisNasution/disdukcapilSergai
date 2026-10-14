<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<div class="qna-tabs">
    <a href="<?= base_url('admin/struktur') ?>" 
       class="qna-tab">
        <i class="fas fa-users"></i> Struktur Organisasi
    </a>
    <a href="<?= base_url('admin/datapeg') ?>" 
       class="qna-tab active">
        <i class="fas fa-users"></i> Data Pegawai
    </a>
    <a href="<?= base_url('admin/pegterbaik') ?>" 
       class="qna-tab">
        <i class="fas fa-users"></i> Pegawai Terbaik
    </a>
</div>

<div style="overflow-x: auto;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th >Kategori</th>
                <th>Jumlah</th>
                <th style="width: 20px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datapegawai)): ?>
                <?php $no = 1; ?>
                <?php foreach ($datapegawai as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['data_pegawai_name'] ?></td>
                        <td><?= $item['data_pegawai_jumlah'] ?></td>
                        <td style=" min-width: 20px !important;">
                            <a href="<?= base_url('admin/datapeg/edit/' . $item['data_pegawai_id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data Pegawai.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>