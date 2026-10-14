<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - Disdukcapil' ?></title>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?= base_url('assets/images/logoSergai.png') ?>"
    />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
    <div class="admin-wrapper">
        
        
        <button class="burger-btn" id="burgerBtn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-logo">
                <img
                    src="<?= base_url('assets/images/capilLogo.png') ?>"
                    alt="Logo Disdukcapil"
                    class="brand-logo"
                />
                <h2>Admin Panel</h2>
                <p>Disdukcapil Sergai</p>
            </div>
            <div class="nav-scroll-area">
                <nav class="admin-nav" style="max-height: calc(100vh - 100px); overflow-y: auto;">
                    <ul>
                        <li><a href="<?= base_url('admin/dashboard') ?>" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="<?= base_url('admin/beranda/'. 1 .'/slider') ?>" class=""><i class="fas fa-home"></i> Beranda</a></li>
                        <li><a href="<?= base_url('admin/visimisi') ?>" class=""><i class="fas fa-clipboard-check"></i> Profile</a></li>
                        <li><a href="<?= base_url('admin/struktur') ?>" class=""><i class="fas fa-users"></i> Kepegawaian</a></li>
                        <li><a href="<?= base_url('admin/datapend') ?>"><i class="fas fa-chart-line"></i> Data Kependudukan</a></li>
                        <li><a href="<?= base_url('admin/kepuasan') ?>"><i class="fas fa-star"></i> Kepuasan Masyarakat</a></li>
                        <li><a href="<?= base_url('admin/penilaian/'. 1 . '/kemendagri') ?>"><i class="fas fa-clipboard-check"></i> Penilaian</a></li>
                        <li><a href="<?= base_url('admin/peruu') ?>"><i class="fas fa-file-contract"></i> Peraturan</a></li>
                        <li><a href="<?= base_url('admin/pengaduan') ?>"><i class="fas fa-bullhorn"></i> Pengaduan</a></li>
                        <li><a href="<?= base_url('admin/penghargaan') ?>"><i class="fas fa-trophy"></i> Penghargaan</a></li>
                        <li><a href="<?= base_url('admin/kerjasama') ?>"><i class="fas fa-handshake"></i> Kerja Sama</a></li>
                        <li><a href="<?= base_url('admin/inovasi/'. 1 . '/kolaborasi') ?>"><i class="fas fa-lightbulb"></i> Inovasi</a></li>
                        <li><a href="<?= base_url('admin/persyaratan') ?>"><i class="fas fa-clipboard-list"></i> Persyaratan</a></li>
                        <li><a href="<?= base_url('admin/jaditau') ?>"><i class="fas fa-info-circle"></i> JADI TAU</a></li>
                        <li><a href="<?= base_url('admin/qna') ?>"><i class="fas fa-comments"></i> Tanya Jawab</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        
        <main class="admin-main">
            <header class="admin-topbar">
                <h3><?= $title ?? 'Dashboard' ?></h3>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span style="font-size: 0.85rem; color: #666;">
                        <i class="fas fa-user-circle"></i>
                        <?= esc(session()->get('admin_name')) ?>
                        <span class="badge-role <?= is_superadmin() ? 'superadmin' : 'admin' ?>">
                            <?= is_superadmin() ? 'Superadmin' : 'Admin' ?>
                        </span>
                    </span>
                    <a href="<?= base_url('/') ?>" class="btn btn-sm btn-outline" target="_blank"><i class="fas fa-eye"></i> Lihat Website</a>
                    <a href="<?= base_url('admin/logout') ?>" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </header>

            <div class="admin-content">
                <?= $this->renderSection('admin_content') ?>
            </div>
        </main>
    </div>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
     
    <script>
        
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('open');
        }

        
        function toggleDropdown(element) {
            const parent = element.parentElement;
            parent.classList.toggle('open');
        }

        
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('adminSidebar');
            const burgerBtn = document.getElementById('burgerBtn');
            
            if (!sidebar.contains(event.target) && !burgerBtn.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>
    <script>
        
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImg = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            
            const alerts = document.querySelectorAll('.alert-success, .alert-danger');
            
            alerts.forEach(alert => {
                
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    
                    
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000); 
            });
        });
    </script>
</body>
</html>