<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('admin_content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kelola Tanya Jawab</h3>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- TABS -->
<div class="qna-tabs">
    <?php /** @var string $activeStatus */ ?>
    <?php /** @var object $counts */ ?>
    <a href="<?= base_url('admin/qna/pending') ?>" 
       class="qna-tab <?= $activeStatus === 'pending' ? 'active' : '' ?>">
        <i class="fas fa-clock"></i> Belum Dijawab
        <span class="badge"><?= $counts['pending'] ?></span>
    </a>
    <a href="<?= base_url('admin/qna/answered') ?>" 
       class="qna-tab <?= $activeStatus === 'answered' ? 'active' : '' ?>">
        <i class="fas fa-check-circle"></i> Sudah Dijawab
        <span class="badge"><?= $counts['answered'] ?></span>
    </a>
    <a href="<?= base_url('admin/qna/rejected') ?>" 
       class="qna-tab <?= $activeStatus === 'rejected' ? 'active' : '' ?>">
        <i class="fas fa-ban"></i> Ditolak
        <span class="badge"><?= $counts['rejected'] ?></span>
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:50px;">No</th>
            <th style="width:150px;">Id</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Pertanyaan</th>
            <th>Tanggal</th>
            <th style="width:200px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($qna)): ?>
            <!-- <?php $no = 1; ?> -->
             <?php /** @var object $pager */ ?>
                <?php 
                $details = $pager->getDetails('default'); 
                $perPage = $details['perPage'];
                $currentPage = $details['currentPage'];
                
                $no = ($currentPage - 1) * $perPage + 1;
                ?>
            <?php foreach ($qna as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($item['qna_id']) ?></td>
                    <td><?= esc($item['qna_name']) ?></td>
                    <td><?= esc($item['qna_id_number']) ?></td>
                    <td><?= character_limiter($item['qna_question'], 50) ?></td>
                    <td><?= date('d M Y', strtotime($item['qna_created_at'])) ?></td>
                    <td>
                        <?php /** @var object $pager */ ?>
                        <?php 
                            
                            $details = $pager->getDetails('default');
                            $currentPage = $details['currentPage'];
                        ?>
                        <?php /** @var string $activeStatus */ ?>
                        <?php if ($activeStatus === 'pending'): ?>
                            <a href="<?= base_url('admin/qna/detail/' . $item['qna_id']) ?>" 
                               class="btn btn-sm btn-primary">
                                <i class="fas fa-reply"></i> Respons
                            </a>
                        <?php elseif ($activeStatus === 'answered'): ?>
                            <a href="<?= base_url('admin/qna/view-answer/' . $item['qna_id']) ?>" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        <?php elseif ($activeStatus === 'rejected'): ?>
                            <a href="<?= base_url('admin/qna/view-reject/' . $item['qna_id']) ?>" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        <?php endif; ?>
                        <!-- <?php if (is_superadmin()): ?> -->
                        <a href="<?= base_url('admin/qna/delete/' . $item['qna_id']) ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                        <!-- <?php endif; ?> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">Tidak ada data.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php /** @var object $pager */ ?>

<div class="pagination-wrapper">
    <?= $pager->links('default', 'admin_pager') ?>
</div>

<?= $this->endSection() ?>