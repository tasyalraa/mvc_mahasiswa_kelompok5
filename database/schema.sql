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
('231001001', 'Andi Pratama', 'FTI', 'Teknik Informatika', 'Banjarmasin', '2004-01-12', 'Laki-laki', 1),
('231001002', 'Siti Aminah', 'FTI', 'Sistem Informasi', 'Banjarbaru', '2004-03-22', 'Perempuan', 1),
('231001003', 'Rizky Maulana', 'FTI', 'Teknik Informatika', 'Martapura', '2003-11-05', 'Laki-laki', 1)
ON DUPLICATE KEY UPDATE npm = npm;
