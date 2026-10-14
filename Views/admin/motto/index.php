<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<div class="qna-tabs">
    <a href="<?= base_url('admin/visimisi') ?>" 
       class="qna-tab">
        <i class="fas fa-clipboard-check"></i> Visi Misi
    </a>
    <a href="<?= base_url('admin/motto') ?>" 
       class="qna-tab active">
        <i class="fas fa-clipboard-check"></i> Motto
    </a>
    <a href="<?= base_url('admin/maklumat') ?>" 
       class="qna-tab">
        <i class="fas fa-clipboard-check"></i> Maklumat
    </a>
</div>

<div style="overflow-x: auto;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width:20px;">Judul</th>
                <th>Keterangan</th>
                <th style="width: 20px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($motto)): ?>
                <?php $no = 1; ?>
                <?php foreach ($motto as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['visimisi_name'] ?></td>
                        <td><?= $item['visimisi_desc'] ?></td>
                        <td style=" min-width: 20px !important;">
                            <a href="<?= base_url('admin/motto/edit/' . $item['visimisi_id']) ?>" class="btn btn-sm btn-warning">
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