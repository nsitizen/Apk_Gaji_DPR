<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <?php if (!session()->get('isLoggedIn')): // JIKA BELUM LOGIN ?>
            
            <a class="navbar-brand fw-bold mx-auto" href="#">Aplikasi Gaji DPR</a>

        <?php else: // JIKA SUDAH LOGIN ?>

            <a class="navbar-brand fw-bold" href="#">Aplikasi Gaji DPR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('role') == 'Admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/anggota') ?>">Kelola Anggota</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/komponengaji') ?>">Kelola Komponen Gaji</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/penggajian') ?>">Kelola Penggajian</a></li>
                    <?php elseif (session()->get('role') == 'Public'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('public/dashboard') ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('public/anggota') ?>">Lihat Anggota</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('public/penggajian') ?>">Lihat Penggajian</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="btn btn-danger ms-2" href="<?= site_url('logout') ?>">Logout</a></li>
                </ul>
            </div>

        <?php endif; ?>
        
    </div>
</nav>