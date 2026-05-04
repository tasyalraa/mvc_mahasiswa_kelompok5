<div class="container mt-4">

    <h2 class="mb-4">Data Mahasiswa</h2>

    <!-- FLASH MESSAGE -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- BUTTON TAMBAH -->
    <div class="mb-3">
        <a href="<?= BASEURL; ?>/mahasiswa/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- EXPORT -->
    <?php
    $queryString = http_build_query([
        'search' => $search ?? '',
        'jurusan' => $jurusan ?? ''
    ]);
    ?>

    <div class="mb-3">
        <a href="<?= BASEURL; ?>/mahasiswa/exportCSV?<?= $queryString; ?>" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export CSV
        </a>

        <a href="<?= BASEURL; ?>/mahasiswa/exportPDF?<?= $queryString; ?>" class="btn btn-danger btn-sm">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>

    <!-- FORM SEARCH -->
    <form action="<?= BASEURL; ?>/mahasiswa" method="GET" class="row g-3 mb-4">

        <div class="col-md-4">
            <label class="form-label">Cari NPM / Nama</label>
            <input 
                type="text" 
                name="search" 
                class="form-control"
                value="<?= htmlspecialchars($search ?? ''); ?>" 
                placeholder="Masukkan NPM atau nama"
            >
        </div>

        <div class="col-md-4">
            <label class="form-label">Filter Jurusan</label>
            <select name="jurusan" class="form-select">
                <option value="">Semua Jurusan</option>
                <option value="Teknik Informatika" <?= ($jurusan ?? '') === 'Teknik Informatika' ? 'selected' : ''; ?>>
                    Teknik Informatika
                </option>
                <option value="Sistem Informasi" <?= ($jurusan ?? '') === 'Sistem Informasi' ? 'selected' : ''; ?>>
                    Sistem Informasi
                </option>
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Cari
            </button>

            <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-secondary">
                Reset
            </a>
        </div>
    </form>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($mahasiswa)) : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($mhs['npm']); ?></td>
                            <td><?= htmlspecialchars($mhs['nama_lengkap']); ?></td>
                            <td><?= htmlspecialchars($mhs['fakultas']); ?></td>
                            <td><?= htmlspecialchars($mhs['jurusan']); ?></td>
                            <td><?= htmlspecialchars($mhs['tempat_lahir']); ?></td>
                            <td><?= htmlspecialchars($mhs['tanggal_lahir']); ?></td>
                            <td><?= htmlspecialchars($mhs['jenis_kelamin']); ?></td>
                            <td>
                                <?php if ($mhs['status_id'] == 1): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <!-- EDIT -->
                                <a href="<?= BASEURL; ?>/mahasiswa/edit/<?= $mhs['id']; ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- DELETE -->
                                <a href="<?= BASEURL; ?>/mahasiswa/delete/<?= $mhs['id']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else : ?>
                    <tr>
                        <td colspan="10" class="text-center">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>