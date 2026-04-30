<h1>Tambah Mahasiswa</h1>

<?php if (!empty($flash)) : ?>
    <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
        <?= htmlspecialchars($flash['message']); ?>
    </div>
<?php endif; ?>

<form action="<?= BASEURL; ?>/mahasiswa/store" method="POST">
    <p>
        <label>NPM</label><br>
        <input type="text" name="npm" value="<?= htmlspecialchars($old['npm'] ?? ''); ?>">
    </p>

    <p>
        <label>Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($old['nama_lengkap'] ?? ''); ?>">
    </p>

    <p>
        <label>Fakultas</label><br>
        <input type="text" name="fakultas" value="<?= htmlspecialchars($old['fakultas'] ?? 'FTI'); ?>">
    </p>

    <p>
        <label>Jurusan</label><br>
        <select name="jurusan">
            <option value="">-- Pilih Jurusan --</option>
            <option value="Teknik Informatika" <?= ($old['jurusan'] ?? '') === 'Teknik Informatika' ? 'selected' : ''; ?>>
                Teknik Informatika
            </option>
            <option value="Sistem Informasi" <?= ($old['jurusan'] ?? '') === 'Sistem Informasi' ? 'selected' : ''; ?>>
                Sistem Informasi
            </option>
        </select>
    </p>

    <p>
        <label>Tempat Lahir</label><br>
        <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($old['tempat_lahir'] ?? ''); ?>">
    </p>

    <p>
        <label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($old['tanggal_lahir'] ?? ''); ?>">
    </p>

    <p>
        <label>Jenis Kelamin</label><br>

        <label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($old['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'checked' : ''; ?>>
            Laki-laki
        </label>

        <label>
            <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($old['jenis_kelamin'] ?? '') === 'Perempuan' ? 'checked' : ''; ?>>
            Perempuan
        </label>
    </p>

    <button type="submit">Simpan</button>
    <a href="<?= BASEURL; ?>/mahasiswa">Kembali</a>
</form>
