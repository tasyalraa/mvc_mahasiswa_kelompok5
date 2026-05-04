<?php

class MahasiswaController extends Controller
{
    public function index()
{
    $mahasiswaModel = $this->model('Mahasiswa');

    $search = trim($_GET['search'] ?? '');
    $jurusan = trim($_GET['jurusan'] ?? '');

    if ($search !== '' || $jurusan !== '') {
        $mahasiswa = $mahasiswaModel->searchAndFilter($search, $jurusan);
    } else {
        $mahasiswa = $mahasiswaModel->getAll();
    }

    $data = [
        'title' => 'Data Mahasiswa',
        'mahasiswa' => $mahasiswa,
        'search' => $search,
        'jurusan' => $jurusan,
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

private function getExportData()
{
    $mahasiswaModel = $this->model('Mahasiswa');

    $search = trim($_GET['search'] ?? '');
    $jurusan = trim($_GET['jurusan'] ?? '');

    if ($search !== '' || $jurusan !== '') {
        return $mahasiswaModel->searchAndFilter($search, $jurusan);
    }

    return $mahasiswaModel->getAll();
}
public function exportCSV()
{
    $data = $this->getExportData();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="data_mahasiswa.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'ID',
        'NPM',
        'Nama Lengkap',
        'Fakultas',
        'Jurusan',
        'Tempat Lahir',
        'Tanggal Lahir',
        'Jenis Kelamin',
        'Status'
    ]);

    foreach ($data as $mhs) {
        fputcsv($output, [
            $mhs['id'],
            $mhs['npm'],
            $mhs['nama_lengkap'],
            $mhs['fakultas'],
            $mhs['jurusan'],
            $mhs['tempat_lahir'],
            $mhs['tanggal_lahir'],
            $mhs['jenis_kelamin'],
            $mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif'
        ]);
    }

    fclose($output);
    exit;
}

public function exportPDF()
{
    require_once __DIR__ . '/../../vendor/autoload.php';

    $data = $this->getExportData();

    $html = '
    <h2>Data Mahasiswa</h2>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NPM</th>
                <th>Nama Lengkap</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach ($data as $mhs) {
        $status = $mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif';

        $html .= '
            <tr>
                <td>' . htmlspecialchars($mhs['id']) . '</td>
                <td>' . htmlspecialchars($mhs['npm']) . '</td>
                <td>' . htmlspecialchars($mhs['nama_lengkap']) . '</td>
                <td>' . htmlspecialchars($mhs['fakultas']) . '</td>
                <td>' . htmlspecialchars($mhs['jurusan']) . '</td>
                <td>' . htmlspecialchars($mhs['tempat_lahir']) . '</td>
                <td>' . htmlspecialchars($mhs['tanggal_lahir']) . '</td>
                <td>' . htmlspecialchars($mhs['jenis_kelamin']) . '</td>
                <td>' . htmlspecialchars($status) . '</td>
            </tr>
        ';
    }

    $html .= '
        </tbody>
    </table>
    ';

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('data_mahasiswa.pdf', ['Attachment' => false]);

    exit;
}
}