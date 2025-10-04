<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Gaji DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

    <?php?>
    <?= $this->include('templates/header') ?>

    <main class="flex-shrink-0">
        <div class="container mt-4">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <?php?>
    <?= $this->include('templates/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>