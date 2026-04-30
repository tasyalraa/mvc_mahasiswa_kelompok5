# 📘 Dokumentasi Praktikum PHP MVC

## Sesi 1 – Persiapan Proyek

### 👥 Identitas Kelompok

* Nama Kelompok: Kelompok 5
* Backend Engineer (BE): Noor Shahla Qeysha Revarani
* Frontend Engineer (FE): Patimatul Jahrah (2310010234)
* Documentation & Debugging Officer (DDO): Tasya Rosalinda (2310010225)

---

### 🎯 Tujuan Sesi

Pada sesi ini, kami mempelajari dasar arsitektur MVC serta menyiapkan lingkungan pengembangan. Fokus utama adalah membuat struktur proyek, menghubungkan database, dan memastikan aplikasi dapat berjalan dengan baik.

---

### 🧱 Struktur Proyek

Struktur folder utama yang digunakan dalam proyek ini adalah:

```
mvc_mahasiswa_kelompok5/
├── app/
├── config/
├── core/
├── public/
├── docs/
```

Struktur ini mengikuti pola MVC (Model-View-Controller) yang memisahkan logika program, tampilan, dan pengolahan data.

---

### ⚙️ Konfigurasi Database

Database yang digunakan:

* Nama database: `uniska_latihan_mvc_2026`
* DBMS: MySQL (Laragon)

Koneksi database dilakukan menggunakan PDO dengan konfigurasi host `localhost`, username `root`, dan password kosong.

---

### 🧪 Hasil Pengujian

Pengujian dilakukan dengan menjalankan file `test_db.php` untuk memastikan koneksi database berhasil.

Hasil:

* Koneksi ke database berhasil
* Tidak terdapat error pada konfigurasi awal

---

### 📸 Dokumentasi Screenshot

#### 1. Struktur Folder di VSCode

![Struktur Folder](docs/sesi1_struktur.png)

#### 2. Isi Folder Public

![Folder Public](docs/sesi1_index.png)
![Folder Public](docs/sesi1_test_db.png)

#### 3. Koneksi Database Berhasil

![Koneksi Database](docs/sesi1_koneksi.png)

#### 4. Database di phpMyAdmin

![Database](docs/sesi1_table_mahasiswa.png)

---

### 🐛 Kendala yang Dihadapi

Beberapa kendala yang sempat terjadi:

* Error 404 akibat file `.htaccess` belum lengkap
* Perbedaan environment antara XAMPP dan Laragon
* Database belum dibuat sehingga koneksi gagal

---

### ✅ Solusi

* Menambahkan file `.htaccess` pada folder `public`
* Menyesuaikan URL dengan environment Laragon
* Membuat database sesuai dengan konfigurasi

---

### 📌 Kesimpulan

Pada sesi ini, proyek berhasil disiapkan dengan baik. Struktur MVC sudah terbentuk, koneksi database berhasil dilakukan, dan aplikasi siap dikembangkan ke tahap berikutnya.

---

---

## 📘 Sesi 2 – Implementasi Routing

### 🎯 Tujuan Sesi

Pada sesi ini, kami mulai mengimplementasikan sistem routing dalam arsitektur MVC. Routing berfungsi untuk mengarahkan URL ke controller dan method yang sesuai.

---

### 🧠 Konsep Dasar

Routing bekerja dengan pola URL sebagai berikut:

```
/controller/method
```

Contoh:

```
/home/index
```

Artinya:

* Controller: HomeController
* Method: index()

---

### ⚙️ Implementasi

Pada sesi ini dilakukan:

* Pembuatan class `Router.php`
* Pembuatan base `Controller.php`
* Pembuatan controller awal `HomeController`
* Parsing URL untuk menentukan controller dan method

---

### 🧪 Hasil Pengujian

Pengujian dilakukan dengan mengakses URL:

```
http://mvc_mahasiswa_kelompok5.test/home/index
```

Hasil:

* Routing berjalan dengan baik
* Controller berhasil dipanggil
* Method `index()` berhasil dijalankan

---

### 📸 Dokumentasi Screenshot

#### 1. File Router.php

![Router](docs/sesi2_router.png)

#### 2. HomeController

![Controller](docs/sesi2_controller.png)

#### 3. View Home (index.php)

![View](docs/sesi2_index.png)

#### 4. Hasil di Browser

![Output](docs/sesi2_output.png)

---

### 🐛 Kendala yang Dihadapi

Beberapa kendala yang muncul:

* Error controller tidak ditemukan
* Method tidak dikenali
* Kesalahan penulisan URL

---

### ✅ Solusi

* Memastikan nama controller sesuai dengan yang dipanggil
* Menambahkan method yang dibutuhkan dalam controller
* Memperbaiki parsing URL pada Router

---

### 📌 Kesimpulan

Pada sesi ini, sistem routing berhasil diimplementasikan. Aplikasi sudah mampu mengarahkan URL ke controller dan method yang sesuai, sehingga menjadi dasar penting dalam pengembangan aplikasi berbasis MVC.

---
