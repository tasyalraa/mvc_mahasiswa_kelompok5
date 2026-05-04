<?php

class ApiMahasiswaController extends Controller
{
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    private function getJsonInput()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        return is_array($data) ? $data : [];
    }

    private function validateMahasiswaData($data)
    {
        $npm = trim($data['npm'] ?? '');
        $nama_lengkap = trim($data['nama_lengkap'] ?? '');
        $fakultas = trim($data['fakultas'] ?? '');
        $jurusan = trim($data['jurusan'] ?? '');
        $tempat_lahir = trim($data['tempat_lahir'] ?? '');
        $tanggal_lahir = trim($data['tanggal_lahir'] ?? '');
        $jenis_kelamin = trim($data['jenis_kelamin'] ?? '');

        $validJurusan = ['Teknik Informatika', 'Sistem Informasi'];
        $validJenisKelamin = ['Laki-laki', 'Perempuan'];

        if ($npm === '') {
            return ['valid' => false, 'message' => 'NPM tidak boleh kosong.'];
        }

        if ($nama_lengkap === '') {
            return ['valid' => false, 'message' => 'Nama lengkap tidak boleh kosong.'];
        }

        if ($fakultas === '') {
            return ['valid' => false, 'message' => 'Fakultas tidak boleh kosong.'];
        }

        if (!in_array($jurusan, $validJurusan)) {
            return ['valid' => false, 'message' => 'Jurusan tidak valid.'];
        }

        if ($tempat_lahir === '') {
            return ['valid' => false, 'message' => 'Tempat lahir tidak boleh kosong.'];
        }

        if ($tanggal_lahir === '') {
            return ['valid' => false, 'message' => 'Tanggal lahir tidak boleh kosong.'];
        }

        if (!in_array($jenis_kelamin, $validJenisKelamin)) {
            return ['valid' => false, 'message' => 'Jenis kelamin tidak valid.'];
        }

        return [
            'valid' => true,
            'data' => [
                'npm' => $npm,
                'nama_lengkap' => $nama_lengkap,
                'fakultas' => $fakultas,
                'jurusan' => $jurusan,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin
            ]
        ];
    }

    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');
        $mahasiswa = $mahasiswaModel->getAll();

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil diambil.',
            'data' => $mahasiswa
        ], 200);
    }

    public function show($id)
    {
        $mahasiswaModel = $this->model('Mahasiswa');
        $mahasiswa = $mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan.'
            ], 404);
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil ditemukan.',
            'data' => $mahasiswa
        ], 200);
    }

    public function store()
    {
        $input = $this->getJsonInput();
        $validation = $this->validateMahasiswaData($input);

        if (!$validation['valid']) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => $validation['message']
            ], 400);
        }

        $mahasiswaModel = $this->model('Mahasiswa');

        if ($mahasiswaModel->findByNpm($validation['data']['npm'])) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'NPM sudah terdaftar.'
            ], 400);
        }

        $created = $mahasiswaModel->create($validation['data']);

        if (!$created) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa gagal ditambahkan.'
            ], 500);
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil ditambahkan.'
        ], 201);
    }

    public function update($id)
    {
        $mahasiswaModel = $this->model('Mahasiswa');
        $mahasiswa = $mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan.'
            ], 404);
        }

        $input = $this->getJsonInput();
        $validation = $this->validateMahasiswaData($input);

        if (!$validation['valid']) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => $validation['message']
            ], 400);
        }

        $existingNpm = $mahasiswaModel->findByNpm($validation['data']['npm']);

        if ($existingNpm && $existingNpm['id'] != $id) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'NPM sudah digunakan oleh mahasiswa lain.'
            ], 400);
        }

        $updated = $mahasiswaModel->update($id, $validation['data']);

        if (!$updated) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa gagal diperbarui.'
            ], 500);
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil diperbarui.'
        ], 200);
    }

    public function delete($id)
    {
        $mahasiswaModel = $this->model('Mahasiswa');
        $mahasiswa = $mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan.'
            ], 404);
        }

        $deleted = $mahasiswaModel->delete($id);

        if (!$deleted) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Data mahasiswa gagal dihapus.'
            ], 500);
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil dihapus.'
        ], 200);
    }

    public function methodNotAllowed()
    {
        $this->jsonResponse([
            'status' => 'error',
            'message' => 'Method tidak diizinkan.'
        ], 405);
    }
}
