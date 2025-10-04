<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header"><h3><?= esc($title) ?>: <?= esc($anggota['nama_depan']) ?></h3></div>
        <div class="card-body">
            <form action="<?= site_url('admin/penggajian/update/' . $anggota['id_anggota']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Pilih Ulang Komponen Gaji</label>
                    <?php foreach($semua_komponen as $k): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="komponen_ids[]" value="<?= $k['id_komponen_gaji'] ?>" id="k_<?= $k['id_komponen_gaji'] ?>"
                            <?= in_array($k['id_komponen_gaji'], $ids_komponen_dimiliki) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="k_<?= $k['id_komponen_gaji'] ?>">
                            <?= esc($k['nama_komponen']) ?> (Jabatan: <strong><?= esc($k['jabatan']) ?></strong>)
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>