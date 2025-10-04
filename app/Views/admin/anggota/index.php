<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4"><?= esc($title) ?></h2>
    <a href="<?= site_url('admin/anggota/new') ?>" class="btn btn-primary mb-3">Tambah Data</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggota as $item): ?>
            <tr>
                <td><?= esc($item['id_anggota']) ?></td>
                <td><?= esc($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang']) ?></td>
                <td><?= esc($item['jabatan']) ?></td>
                <td>
                    <a href="<?= site_url('admin/anggota/' . $item['id_anggota']) ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="<?= site_url('admin/anggota/edit/' . $item['id_anggota']) ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="<?= site_url('admin/anggota/delete/' . $item['id_anggota']) ?>" class="btn btn-danger btn-sm btn-delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>