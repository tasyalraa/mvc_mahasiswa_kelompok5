<?php

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $mahasiswaModel->getAll()
        ];

        $this->view('mahasiswa/index', $data);
    }
}
