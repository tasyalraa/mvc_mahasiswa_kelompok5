<?php

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $mahasiswaModel->getAll(),
            'flash' => $this->flash()
        ];

        $this->view('mahasiswa/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Mahasiswa',
            'flash' => $this->flash(),
            'old' => $_SESSION['old'] ?? []
        ];

        unset($_SESSION['old']);

        $this->view('mahasiswa/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('mahasiswa/create');
        }

        $mahasiswaModel = $this->model('Mahasiswa');

        $npm = trim($_POST['npm'] ?? '');
        $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
        $fakultas = trim($_POST['fakultas'] ?? '');
        $jurusan = trim($_POST['jurusan'] ?? '');
        $tempat_lahir = trim($_POST['tempat_lahir'] ?? '');
        $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
        $jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');

        $_SESSION['old'] = [
            'npm' => $npm,
            'nama_lengkap' => $nama_lengkap,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin
        ];

        $validJurusan = ['Teknik Informatika', 'Sistem Informasi'];
        $validJenisKelamin = ['Laki-laki', 'Perempuan'];

        if ($npm === '') {
            $this->setFlash('danger', 'NPM tidak boleh kosong.');
            $this->redirect('mahasiswa/create');
        }

        if ($nama_lengkap === '') {
            $this->setFlash('danger', 'Nama lengkap tidak boleh kosong.');
            $this->redirect('mahasiswa/create');
        }

        if (!in_array($jurusan, $validJurusan)) {
            $this->setFlash('danger', 'Jurusan tidak valid.');
            $this->redirect('mahasiswa/create');
        }

        if (!in_array($jenis_kelamin, $validJenisKelamin)) {
            $this->setFlash('danger', 'Jenis kelamin tidak valid.');
            $this->redirect('mahasiswa/create');
        }

        if ($mahasiswaModel->findByNpm($npm)) {
            $this->setFlash('danger', 'NPM sudah terdaftar. Gunakan NPM lain.');
            $this->redirect('mahasiswa/create');
        }

        $data = [
            'npm' => $npm,
            'nama_lengkap' => $nama_lengkap,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin
        ];

        $created = $mahasiswaModel->create($data);

        if ($created) {
            unset($_SESSION['old']);
            $this->setFlash('success', 'Data mahasiswa berhasil ditambahkan.');
            $this->redirect('mahasiswa');
        }

        $this->setFlash('danger', 'Data mahasiswa gagal ditambahkan.');
        $this->redirect('mahasiswa/create');
    }
    public function edit($id)
{
    $mahasiswaModel = $this->model('Mahasiswa');
    $mahasiswa = $mahasiswaModel->find($id);

    if (!$mahasiswa) {
        $this->setFlash('danger', 'Data mahasiswa tidak ditemukan.');
        $this->redirect('mahasiswa');
    }

    $data = [
        'title' => 'Edit Mahasiswa',
        'mahasiswa' => $mahasiswa,
        'flash' => $this->flash()
    ];

    $this->view('mahasiswa/edit', $data);
}

public function update($id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('mahasiswa');
    }

    $mahasiswaModel = $this->model('Mahasiswa');
    $mahasiswa = $mahasiswaModel->find($id);

    if (!$mahasiswa) {
        $this->setFlash('danger', 'Data mahasiswa tidak ditemukan.');
        $this->redirect('mahasiswa');
    }

    $npm = trim($_POST['npm'] ?? '');
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $fakultas = trim($_POST['fakultas'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $tempat_lahir = trim($_POST['tempat_lahir'] ?? '');
    $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
    $jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');

    $validJurusan = ['Teknik Informatika', 'Sistem Informasi'];
    $validJenisKelamin = ['Laki-laki', 'Perempuan'];

    if ($npm === '') {
        $this->setFlash('danger', 'NPM tidak boleh kosong.');
        $this->redirect('mahasiswa/edit/' . $id);
    }

    if ($nama_lengkap === '') {
        $this->setFlash('danger', 'Nama lengkap tidak boleh kosong.');
        $this->redirect('mahasiswa/edit/' . $id);
    }

    if (!in_array($jurusan, $validJurusan)) {
        $this->setFlash('danger', 'Jurusan tidak valid.');
        $this->redirect('mahasiswa/edit/' . $id);
    }

    if (!in_array($jenis_kelamin, $validJenisKelamin)) {
        $this->setFlash('danger', 'Jenis kelamin tidak valid.');
        $this->redirect('mahasiswa/edit/' . $id);
    }

    $existingNpm = $mahasiswaModel->findByNpm($npm);

    if ($existingNpm && $existingNpm['id'] != $id) {
        $this->setFlash('danger', 'NPM sudah digunakan oleh mahasiswa lain.');
        $this->redirect('mahasiswa/edit/' . $id);
    }

    $data = [
        'npm' => $npm,
        'nama_lengkap' => $nama_lengkap,
        'fakultas' => $fakultas,
        'jurusan' => $jurusan,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'jenis_kelamin' => $jenis_kelamin
    ];

    $updated = $mahasiswaModel->update($id, $data);

    if ($updated) {
        $this->setFlash('success', 'Data mahasiswa berhasil diperbarui.');
        $this->redirect('mahasiswa');
    }

    $this->setFlash('danger', 'Data mahasiswa gagal diperbarui.');
    $this->redirect('mahasiswa/edit/' . $id);
}

public function delete($id)
{
    $mahasiswaModel = $this->model('Mahasiswa');
    $mahasiswa = $mahasiswaModel->find($id);

    if (!$mahasiswa) {
        $this->setFlash('danger', 'Data mahasiswa tidak ditemukan.');
        $this->redirect('mahasiswa');
    }

    $deleted = $mahasiswaModel->delete($id);

    if ($deleted) {
        $this->setFlash('success', 'Data mahasiswa berhasil dihapus.');
    } else {
        $this->setFlash('danger', 'Data mahasiswa gagal dihapus.');
    }

    $this->redirect('mahasiswa');
}
}