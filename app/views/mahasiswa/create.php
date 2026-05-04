<div class="container mt-4">

    <h2 class="mb-4">Tambah Mahasiswa</h2>

    <!-- FLASH MESSAGE -->
    <?php if (!empty($flash)) : ?>
        <div class="alert alert-info alert-dismissible fade show">
            <?= htmlspecialchars($flash['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="<?= BASEURL; ?>/mahasiswa/store" method="POST">

                <!-- NPM -->
                <div class="mb-3">
                    <label class="form-label">NPM</label>
                    <input type="text" name="npm" class="form-control"
                        value="<?= htmlspecialchars($old['npm'] ?? ''); ?>"
                        placeholder="Masukkan NPM">
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control"
                        value="<?= htmlspecialchars($old['nama_lengkap'] ?? ''); ?>"
                        placeholder="Masukkan Nama Lengkap">
                </div>

                <!-- Fakultas -->
                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <input type="text" name="fakultas" class="form-control"
                        value="<?= htmlspecialchars($old['fakultas'] ?? 'FTI'); ?>"
                        placeholder="Fakultas">
                </div>

                <!-- Jurusan -->
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika"
                            <?= ($old['jurusan'] ?? '') === 'Teknik Informatika' ? 'selected' : ''; ?>>
                            Teknik Informatika
                        </option>
                        <option value="Sistem Informasi"
                            <?= ($old['jurusan'] ?? '') === 'Sistem Informasi' ? 'selected' : ''; ?>>
                            Sistem Informasi
                        </option>
                    </select>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control"
                        value="<?= htmlspecialchars($old['tempat_lahir'] ?? ''); ?>"
                        placeholder="Tempat Lahir">
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="<?= htmlspecialchars($old['tanggal_lahir'] ?? ''); ?>">
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                            value="Laki-laki"
                            <?= ($old['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'checked' : ''; ?>>
                        <label class="form-check-label">Laki-laki</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                            value="Perempuan"
                            <?= ($old['jenis_kelamin'] ?? '') === 'Perempuan' ? 'checked' : ''; ?>>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>