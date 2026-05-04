<div class="container mt-4">

    <h2 class="mb-4">Edit Mahasiswa</h2>

    <!-- FLASH MESSAGE -->
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?= BASEURL; ?>/mahasiswa/update/<?= $mahasiswa['id']; ?>" method="POST">

        <div class="card shadow-sm">
            <div class="card-body">

                <!-- NPM -->
                <div class="mb-3">
                    <label class="form-label">NPM</label>
                    <input type="text" name="npm" class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['npm']); ?>" required>
                </div>

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['nama_lengkap']); ?>" required>
                </div>

                <!-- FAKULTAS -->
                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <input type="text" name="fakultas" class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['fakultas']); ?>">
                </div>

                <!-- JURUSAN -->
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select">
                        <option value="Teknik Informatika" <?= $mahasiswa['jurusan'] === 'Teknik Informatika' ? 'selected' : ''; ?>>
                            Teknik Informatika
                        </option>
                        <option value="Sistem Informasi" <?= $mahasiswa['jurusan'] === 'Sistem Informasi' ? 'selected' : ''; ?>>
                            Sistem Informasi
                        </option>
                    </select>
                </div>

                <!-- TEMPAT LAHIR -->
                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['tempat_lahir']); ?>">
                </div>

                <!-- TANGGAL LAHIR -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['tanggal_lahir']); ?>">
                </div>

                <!-- JENIS KELAMIN -->
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki"
                            <?= $mahasiswa['jenis_kelamin'] === 'Laki-laki' ? 'checked' : ''; ?>>
                        <label class="form-check-label">Laki-laki</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan"
                            <?= $mahasiswa['jenis_kelamin'] === 'Perempuan' ? 'checked' : ''; ?>>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>

    </form>

</div>