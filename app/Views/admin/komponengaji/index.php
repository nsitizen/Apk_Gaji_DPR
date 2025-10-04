<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4"><?= esc($title) ?></h2>
    <a href="<?= site_url('admin/komponengaji/new') ?>" class="btn btn-primary mb-3">Tambah Komponen</a>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Komponen</th>
                <th>Kategori</th>
                <th>Jabatan</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($komponen as $item): ?>
            <tr>
                <td><?= esc($item['id_komponen_gaji']) ?></td>
                <td><?= esc($item['nama_komponen']) ?></td>
                <td><?= esc($item['kategori']) ?></td>
                <td><?= esc($item['jabatan']) ?></td>
                <td>Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                <td>
                    <a href="<?= site_url('admin/komponengaji/' . $item['id_komponen_gaji']) ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="<?= site_url('admin/komponengaji/edit/' . $item['id_komponen_gaji']) ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="<?= site_url('admin/komponengaji/delete/' . $item['id_komponen_gaji']) ?>" class="btn btn-danger btn-sm btn-delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>