<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header"><h3><?= esc($title) ?></h3></div>
        <div class="card-body">
            <form action="<?= site_url('admin/penggajian/create') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="id_anggota" class="form-label">Pilih Anggota</label>
                    <select name="id_anggota" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach($anggota as $a): ?>
                        <option value="<?= $a['id_anggota'] ?>"><?= esc($a['nama_depan'].' '.$a['nama_belakang']) ?> (<?= esc($a['jabatan']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Pilih Komponen Gaji & Tunjangan</label>
                    <?php foreach($komponen_gaji as $k): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="komponen_ids[]" value="<?= $k['id_komponen_gaji'] ?>" id="k_<?= $k['id_komponen_gaji'] ?>">
                        <label class="form-check-label" for="k_<?= $k['id_komponen_gaji'] ?>">
                            <?= esc($k['nama_komponen']) ?> (Jabatan: <strong><?= esc($k['jabatan']) ?></strong>)
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>