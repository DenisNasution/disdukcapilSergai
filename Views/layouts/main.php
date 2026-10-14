<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
      name="description"
      content="Website Resmi Dinas Kependudukan dan Catatan Sipil Kabupaten Serdang Bedagai"
    />

    <meta
      name="Dinas Kependudukan dan Catatan Sipil Kabupaten Serdang Bedagai"
      content="https://disdukcapil.serdangbedagaikab.go.id/"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Disdukcapil Sergai' ?></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="<?= base_url('assets/images/logoSergai.png') ?>"
    />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

    <?= $this->include('layouts/navbar') ?>
    
    <?= $this->renderSection('content') ?>    

    <?= $this->include('layouts/footer') ?>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>