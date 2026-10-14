<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('admin_content') ?>
<script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name="faq_answer"]',
        height: 400,
        menubar: false,
        plugins: 'lists link code table',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | code | removeformat',
        license_key: 'gpl',
        branding: false,
        promotion: false,
        forced_root_block: false,
        force_br_newlines: true,
        force_p_newlines: false
    });
</script>

<div class="card">
    <div class="card-body">
         <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php /** @var array $faq */ ?>
        <form action="<?= base_url('admin/faq/update/' . $faq['faq_id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="faq_question">Pertanyaan</label>
                <input type="text" class="form-control" name="faq_question" id="faq_question" value="<?= old('faq_question', $faq['faq_question']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="faq_answer"><strong>Jawaban</strong></label>
                <textarea 
                    name="faq_answer" 
                    id="faq_answer" 
                    class="form-control" 
                    rows="10"
                ><?= old('faq_answer') ?><?= old('faq_answer', $faq['faq_answer'] ?? '') ?></textarea>
                <small class="text-muted">
                    Gunakan toolbar di atas untuk menformat teks (bold, list, link, dll).
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/faq') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>