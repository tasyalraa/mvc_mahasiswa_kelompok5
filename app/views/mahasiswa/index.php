<h1>Data Mahasiswa</h1>

<?php if (!empty($flash)) : ?>
    <div style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
        <?= htmlspecialchars($flash['message']); ?>
    </div>
<?php endif; ?>

<p>
    <a href="<?= BASEURL; ?>/mahasiswa/create">Tambah Mahasiswa</a>
</p>

<form action="<?= BASEURL; ?>/mahasiswa" method="GET" style="margin-bottom: 15px;">
    <label>Cari NPM / Nama:</label><br>
    <input 
        type="text" 
        name="search" 
        value="<?= htmlspecialchars($search ?? ''); ?>" 
        placeholder="Masukkan NPM atau nama"
    >

    <br><br>

    <label>Filter Jurusan:</label><br>
    <select name="jurusan">
        <option value="">Semua Jurusan</option>
        <option value="Teknik Informatika" <?= ($jurusan ?? '') === 'Teknik Informatika' ? 'selected' : ''; ?>>
            Teknik Informatika
        </option>
        <option value="Sistem Informasi" <?= ($jurusan ?? '') === 'Sistem Informasi' ? 'selected' : ''; ?>>
            Sistem Informasi
        </option>
    </select>

    <br><br>

    <button type="submit">Cari</button>
    <a href="<?= BASEURL; ?>/mahasiswa">Reset</a>
</form>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
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
            <th>Aksi</th>
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
                    <td><?= $mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif'; ?></td>
                    <td>
                        <a href="<?= BASEURL; ?>/mahasiswa/edit/<?= $mhs['id']; ?>">Edit</a>

                        <a href="<?= BASEURL; ?>/mahasiswa/delete/<?= $mhs['id']; ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else : ?>
            <tr>
                <td colspan="10">Belum ada data mahasiswa.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>