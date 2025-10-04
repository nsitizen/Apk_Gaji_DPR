<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header"><h3>Detail Penggajian: <?= esc($anggota['nama_depan']) ?></h3></div>
        <div class="card-body">
            <h5 class="card-title">Rincian Komponen Gaji</h5>
            <ul class="list-group list-group-flush">
                <?php if (empty($komponen)): ?>
                    <li class="list-group-item">Belum ada rincian gaji untuk ditampilkan.</li>
                <?php else: ?>
                    <?php foreach($komponen as $k): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <?= esc($k['nama_komponen']) ?>
                        <span class="badge bg-info">Rp <?= number_format($k['nominal'], 0, ',', '.') ?></span>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between active">
                    <strong>Total Perkiraan Take Home Pay (Bulanan)</strong>
                    <strong>Rp <?= number_format($take_home_pay, 0, ',', '.') ?></strong>
                </li>
            </ul>
        </div>
        <div class="card-footer"><a href="<?= site_url('public/penggajian') ?>" class="btn btn-secondary">Kembali</a></div>
    </div>
</div>
<?= $this->endSection() ?>