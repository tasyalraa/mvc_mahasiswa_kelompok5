<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Aplikasi Mahasiswa'; ?></title>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASEURL; ?>">
            <i class="bi bi-mortarboard"></i> MVC Mahasiswa
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link <?= ($_GET['url'] ?? '') == '' ? 'active' : ''; ?>"
                       href="<?= BASEURL; ?>">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= str_contains($_GET['url'] ?? '', 'mahasiswa') ? 'active' : ''; ?>"
                       href="<?= BASEURL; ?>/mahasiswa">
                        Data Mahasiswa
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= str_contains($_GET['url'] ?? '', 'create') ? 'active' : ''; ?>"
                       href="<?= BASEURL; ?>/mahasiswa/create">
                        Tambah
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>