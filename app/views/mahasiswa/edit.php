<h1>Edit Mahasiswa</h1>

<?php if (!empty($flash)) : ?>
    <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
        <?= htmlspecialchars($flash['message']); ?>
    </div>
<?php endif; ?>

<form action="<?= BASEURL; ?>/mahasiswa/update/<?= $mahasiswa['id']; ?>" method="POST">
    <p>
        <label>NPM</label><br>
        <input type="text" name="npm" value="<?= htmlspecialchars($mahasiswa['npm']); ?>">
    </p>

    <p>
        <label>Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($mahasiswa['nama_lengkap']); ?>">
    </p>

    <p>
        <label>Fakultas</label><br>
        <input type="text" name="fakultas" value="<?= htmlspecialchars($mahasiswa['fakultas']); ?>">
    </p>

    <p>
        <label>Jurusan</label><br>
        <select name="jurusan">
            <option value="Teknik Informatika" <?= $mahasiswa['jurusan'] === 'Teknik Informatika' ? 'selected' : ''; ?>>
                Teknik Informatika
            </option>
            <option value="Sistem Informasi" <?= $mahasiswa['jurusan'] === 'Sistem Informasi' ? 'selected' : ''; ?>>
                Sistem Informasi
            </option>
        </select>
    </p>

    <p>
        <label>Tempat Lahir</label><br>
        <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($mahasiswa['tempat_lahir']); ?>">
    </p>

    <p>
        <label>Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($mahasiswa['tanggal_lahir']); ?>">
    </p>

    <p>
        <label>Jenis Kelamin</label><br>

        <label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= $mahasiswa['jenis_kelamin'] === 'Laki-laki' ? 'checked' : ''; ?>>
            Laki-laki
        </label>

        <label>
            <input type="radio" name="jenis_kelamin" value="Perempuan" <?= $mahasiswa['jenis_kelamin'] === 'Perempuan' ? 'checked' : ''; ?>>
            Perempuan
        </label>
    </p>

    <button type="submit">Update</button>
    <a href="<?= BASEURL; ?>/mahasiswa">Kembali</a>
</form>
