<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header"><h3><?= esc($title) ?></h3></div>
        <div class="card-body">
            <h5 class="card-title"><?= esc($komponen['nama_komponen']) ?></h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ID Komponen Gaji:</strong> <?= esc($komponen['id_komponen_gaji']) ?></li>
                <li class="list-group-item"><strong>Kategori:</strong> <?= esc($komponen['kategori']) ?></li>
                <li class="list-group-item"><strong>Berlaku untuk Jabatan:</strong> <?= esc($komponen['jabatan']) ?></li>
                <li class="list-group-item"><strong>Nominal:</strong> Rp <?= number_format($komponen['nominal'], 0, ',', '.') ?></li>
                <li class="list-group-item"><strong>Satuan:</strong> <?= esc($komponen['satuan']) ?></li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="<?= site_url('admin/komponengaji') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>