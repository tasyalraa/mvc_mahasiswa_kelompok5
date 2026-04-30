CREATE DATABASE IF NOT EXISTS uniska_latihan_mvc_2026;
USE uniska_latihan_mvc_2026;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status_id INT DEFAULT 1,
    npm VARCHAR(20) UNIQUE,
    nama_lengkap VARCHAR(100),
    fakultas VARCHAR(100),
    jurusan ENUM('Teknik Informatika', 'Sistem Informasi'),
    tempat_lahir VARCHAR(50),
    tanggal_lahir DATE,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan')
);

INSERT INTO mahasiswa 
(npm, nama_lengkap, fakultas, jurusan, tempat_lahir, tanggal_lahir, jenis_kelamin, status_id)
VALUES
('231001001', 'Noor Shahla Qeysha Revarani', 'FTI', 'Teknik Informatika', 'Banjarbaru', '2004-05-23', 'Perempuan', 1),
('231001002', 'Tasya Rosalinda', 'FTI', 'Sistem Informasi', 'Banjarbaru', '2004-03-22', 'Perempuan', 1),
('231001003', 'Patimatul Jahrah', 'FTI', 'Teknik Informatika', 'Martapura', '2003-11-05', 'Perempuan', 1),
('231001004', 'Cici', 'FTI', 'Sistem Informasi', 'Banjarmasin', '2004-07-15', 'Perempuan', 1),
('231001005', 'Patjah', 'FTI', 'Teknik Informatika', 'Banjarbaru', '2004-09-10', 'Perempuan', 1)
ON DUPLICATE KEY UPDATE 
    nama_lengkap = VALUES(nama_lengkap),
    fakultas = VALUES(fakultas),
    jurusan = VALUES(jurusan),
    tempat_lahir = VALUES(tempat_lahir),
    tanggal_lahir = VALUES(tanggal_lahir),
    jenis_kelamin = VALUES(jenis_kelamin),
    status_id = VALUES(status_id);