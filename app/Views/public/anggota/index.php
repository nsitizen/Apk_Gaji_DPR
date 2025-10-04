<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2><?= esc($title) ?></h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggota as $item): ?>
                <tr>
                    <td><?= esc($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang']) ?></td>
                    <td><?= esc($item['jabatan']) ?></td>
                    <td>
                        <a href="<?= site_url('public/anggota/' . $item['id_anggota']) ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>