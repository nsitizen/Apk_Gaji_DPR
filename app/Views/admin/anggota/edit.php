<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><?= esc($title) ?></h3>
        </div>
        <div class="card-body">
            <?php if (session()->get('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/anggota/update/' . $anggota['id_anggota']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="id_anggota" class="form-label">ID Anggota</label>
                    <input type="number" class="form-control" id="id_anggota" name="id_anggota" value="<?= esc($anggota['id_anggota']) ?>" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gelar_depan" class="form-label">Gelar Depan</label>
                            <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= esc($anggota['gelar_depan']) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                            <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?= esc($anggota['gelar_belakang']) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="Ketua" <?= ($anggota['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                                <option value="Wakil Ketua" <?= ($anggota['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                                <option value="Anggota" <?= ($anggota['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select name="status_pernikahan" id="status_pernikahan" class="form-select" required>
                                <option value="">Pilih Status</option>
                                <option value="Kawin" <?= ($anggota['status_pernikahan'] == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                                <option value="Belum Kawin" <?= ($anggota['status_pernikahan'] == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                                <option value="Cerai Hidup" <?= ($anggota['status_pernikahan'] == 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
                                <option value="Cerai Mati" <?= ($anggota['status_pernikahan'] == 'Cerai Mati') ? 'selected' : '' ?>>Cerai Mati</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                    <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="<?= esc($anggota['jumlah_anak']) ?>" required>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>