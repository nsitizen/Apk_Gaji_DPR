<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Selamat Datang, <?= session()->get('nama_depan') ?>!</h1>
            <p class="col-md-8 fs-4">Anda login sebagai <strong>Public User</strong>.</p>
            <p>Silakan gunakan menu navigasi di atas untuk melihat data anggota dan rincian penggajian.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>