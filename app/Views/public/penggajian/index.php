<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4"><?= esc($title) ?></h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Anggota</th>
                    <th>Jabatan</th>
                    <th>Perkiraan Take Home Pay (Bulanan)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penggajian as $item): ?>
                <tr>
                    <td><?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?></td>
                    <td><?= esc($item['jabatan']) ?></td>
                    <td>Rp <?= number_format($item['take_home_pay'], 0, ',', '.') ?></td>
                    <td>
                        <a href="<?= site_url('public/penggajian/' . $item['id_anggota']) ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>