<?= view('templates/header') ?>
<h4>Selamat Datang, <?= session()->get('nama_depan') ?>!</h4>
<p>Anda login sebagai <strong>Admin</strong>.</p>
<?= view('templates/footer') ?>