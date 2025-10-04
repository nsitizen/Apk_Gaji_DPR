<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header"><h3><?= esc($title) ?></h3></div>
        <div class="card-body">
            <?php if (session()->get('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->get('errors') as $error) echo '<p>' . esc($error) . '</p>'; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/komponengaji/create') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="id_komponen_gaji" class="form-label">ID Komponen Gaji</label>
                    <input type="number" class="form-control" id="id_komponen_gaji" name="id_komponen_gaji" value="<?= old('id_komponen_gaji') ?>" required>
                    <div class="form-text">ID harus unik dan tidak boleh sama dengan yang sudah ada.</div>
                </div>
                <div class="mb-3">
                    <label for="nama_komponen" class="form-label">Nama Komponen</label>
                    <input type="text" class="form-control" name="nama_komponen" value="<?= old('nama_komponen') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal (Rp)</label>
                    <input type="number" class="form-control" name="nominal" value="<?= old('nominal') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Gaji Pokok">Gaji Pokok</option>
                        <option value="Tunjangan Melekat">Tunjangan Melekat</option>
                        <option value="Tunjangan Lain">Tunjangan Lain</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                    <select name="jabatan" class="form-select" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Anggota">Anggota</option>
                        <option value="Semua">Semua</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <select name="satuan" class="form-select" required>
                        <option value="">Pilih Satuan</option>
                        <option value="Bulan">Bulan</option>
                        <option value="Hari">Hari</option>
                        <option value="Periode">Periode</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/komponengaji') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>