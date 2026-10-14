<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Disdukcapil Sergai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?= base_url('assets/images/logoSergai.png') ?>"
    />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="containerLogin">

<div class="login-wrapper">
    <div class="login-card">
        
        <div class="login-logo">
            <img src="<?= base_url('assets/images/capilLogo.png') ?>" alt="Logo">
            <h1>Admin Panel</h1>
            <p>Disdukcapil Serdang Bedagai</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left: 20px;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login/attempt') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="<?= old('username') ?>" 
                    placeholder="Masukkan username"
                    required 
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="login-footer">
            &copy; <?= date('Y') ?> Disdukcapil Serdang Bedagai
        </div>

    </div>
</div>

</body>
</html>