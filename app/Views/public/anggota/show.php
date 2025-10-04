<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><?= esc($title) ?></h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= esc($anggota['gelar_depan'] . ' ' . $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] . ', ' . $anggota['gelar_belakang']) ?></h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ID Anggota:</strong> <?= esc($anggota['id_anggota']) ?></li>
                <li class="list-group-item"><strong>Jabatan:</strong> <?= esc($anggota['jabatan']) ?></li>
                <li class="list-group-item"><strong>Status Pernikahan:</strong> <?= esc($anggota['status_pernikahan']) ?></li>
                <li class="list-group-item"><strong>Jumlah Anak:</strong> <?= esc($anggota['jumlah_anak']) ?></li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="<?= site_url('public/anggota') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>