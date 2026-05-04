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

    $tanggalCetak = date('d-m-Y H:i');
    $totalData = count($data);

    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
                color: #222;
                margin: 20px;
            }

            .header {
                text-align: center;
                margin-bottom: 18px;
                padding-bottom: 10px;
                border-bottom: 2px solid #222;
            }

            .header h2 {
                margin: 0;
                font-size: 20px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .header p {
                margin: 4px 0 0 0;
                font-size: 11px;
                color: #555;
            }

            .info {
                margin-bottom: 12px;
                font-size: 11px;
            }

            .info table {
                width: 100%;
                border-collapse: collapse;
            }

            .info td {
                border: none;
                padding: 2px 0;
            }

            .info .label {
                width: 90px;
                font-weight: bold;
            }

            .data-table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }

            .data-table th {
                background-color: #1f2937;
                color: #ffffff;
                border: 1px solid #1f2937;
                padding: 7px 5px;
                font-size: 10px;
                text-align: center;
            }

            .data-table td {
                border: 1px solid #9ca3af;
                padding: 6px 5px;
                font-size: 10px;
                vertical-align: top;
            }

            .data-table tr:nth-child(even) {
                background-color: #f3f4f6;
            }

            .text-center {
                text-align: center;
            }

            .status-aktif {
                font-weight: bold;
                color: #047857;
            }

            .status-nonaktif {
                font-weight: bold;
                color: #b91c1c;
            }

            .footer {
                margin-top: 16px;
                padding-top: 8px;
                border-top: 1px solid #d1d5db;
                text-align: right;
                font-size: 9px;
                color: #666;
            }
        </style>
    </head>
    <body>

        <div class="header">
            <h2>Laporan Data Mahasiswa</h2>
            <p>Aplikasi MVC Mahasiswa - Kelompok 5</p>
        </div>

        <div class="info">
            <table>
                <tr>
                    <td class="label">Tanggal</td>
                    <td>: ' . htmlspecialchars($tanggalCetak) . '</td>
                    <td class="label">Total Data</td>
                    <td>: ' . htmlspecialchars($totalData) . ' mahasiswa</td>
                </tr>
            </table>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 10%;">NPM</th>
                    <th style="width: 21%;">Nama Lengkap</th>
                    <th style="width: 8%;">Fakultas</th>
                    <th style="width: 15%;">Jurusan</th>
                    <th style="width: 12%;">Tempat Lahir</th>
                    <th style="width: 11%;">Tanggal Lahir</th>
                    <th style="width: 10%;">Jenis Kelamin</th>
                    <th style="width: 9%;">Status</th>
                </tr>
            </thead>
            <tbody>
    ';

    if (!empty($data)) {
        $no = 1;

        foreach ($data as $mhs) {
            $status = $mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif';
            $statusClass = $mhs['status_id'] == 1 ? 'status-aktif' : 'status-nonaktif';

            $html .= '
                <tr>
                    <td class="text-center">' . $no++ . '</td>
                    <td>' . htmlspecialchars($mhs['npm']) . '</td>
                    <td>' . htmlspecialchars($mhs['nama_lengkap']) . '</td>
                    <td class="text-center">' . htmlspecialchars($mhs['fakultas']) . '</td>
                    <td>' . htmlspecialchars($mhs['jurusan']) . '</td>
                    <td>' . htmlspecialchars($mhs['tempat_lahir']) . '</td>
                    <td class="text-center">' . htmlspecialchars($mhs['tanggal_lahir']) . '</td>
                    <td class="text-center">' . htmlspecialchars($mhs['jenis_kelamin']) . '</td>
                    <td class="text-center ' . $statusClass . '">' . htmlspecialchars($status) . '</td>
                </tr>
            ';
        }
    } else {
        $html .= '
            <tr>
                <td colspan="9" class="text-center">Tidak ada data mahasiswa.</td>
            </tr>
        ';
    }

    $html .= '
            </tbody>
        </table>

        <div class="footer">
            Dicetak otomatis dari sistem MVC Mahasiswa.
        </div>

    </body>
    </html>
    ';

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('data_mahasiswa.pdf', ['Attachment' => false]);

    exit;
}
}