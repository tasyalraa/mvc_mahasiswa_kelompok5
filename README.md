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

---

## 📘 Sesi 3 – Menampilkan Data Mahasiswa

### 🎯 Tujuan Sesi

Pada sesi ini, kami mulai menghubungkan aplikasi dengan database untuk menampilkan data mahasiswa. Proses ini melibatkan penggunaan Model, Controller, dan View secara terintegrasi.

---

### 🧠 Konsep Dasar

Alur pengambilan data dalam MVC pada sesi ini adalah:

```
Controller → Model → Database → Controller → View
```

Penjelasan:

* Controller memanggil Model
* Model mengambil data dari database
* Data dikembalikan ke Controller
* Controller mengirim data ke View untuk ditampilkan

---

### ⚙️ Implementasi

Pada sesi ini dilakukan:

* Pembuatan Model `Mahasiswa.php`
* Pembuatan `MahasiswaController.php`
* Query database untuk mengambil data mahasiswa
* Pengiriman data ke View
* Pembuatan tampilan tabel mahasiswa

---

### 🧪 Hasil Pengujian

Pengujian dilakukan dengan mengakses URL:

```
http://mvc_mahasiswa_kelompok5.test/mahasiswa/index
```

Hasil:

* Data mahasiswa berhasil diambil dari database
* Data ditampilkan dalam bentuk tabel
* Tidak terdapat error pada proses pengambilan data

---

### 📸 Dokumentasi Screenshot

#### 1. Model Mahasiswa

![Model](docs/sesi3_model.png)

#### 2. MahasiswaController

![Controller](docs/sesi3_controller.png)

#### 3. View Tabel Mahasiswa

![View](docs/sesi3_views.png)

#### 4. Hasil di Browser

![Output](docs/sesi3_output.png)

---

### 🐛 Kendala yang Dihadapi

Beberapa kendala yang muncul:

* Data tidak tampil karena tabel kosong
* Kesalahan query SQL
* Data tidak terkirim dari controller ke view

---

### ✅ Solusi

* Memastikan tabel `mahasiswa` sudah dibuat di database
* Menambahkan data dummy untuk pengujian
* Memperbaiki query SQL dan variabel yang dikirim ke view

---

### 📌 Kesimpulan

Pada sesi ini, aplikasi berhasil menampilkan data dari database ke dalam tampilan web. Implementasi Model mulai berjalan dengan baik dan memperkuat konsep MVC dalam pengembangan aplikasi.

---

---

## 📘 Sesi 4 – Menambahkan Data Mahasiswa

### 🎯 Tujuan Sesi

Pada sesi ini, kami mengimplementasikan fitur untuk menambahkan data mahasiswa ke dalam database melalui form. Proses ini melibatkan interaksi antara View, Controller, dan Model.

---

### 🧠 Konsep Dasar

Alur penambahan data dalam MVC adalah:

```id="n3k8f2"
View (Form) → Controller → Model → Database
```

Penjelasan:

* User mengisi form pada View
* Data dikirim ke Controller menggunakan method POST
* Controller memproses dan meneruskan ke Model
* Model menyimpan data ke database

---

### ⚙️ Implementasi

Pada sesi ini dilakukan:

* Pembuatan form tambah data mahasiswa pada View
* Penambahan method pada `MahasiswaController` untuk menangani input
* Penambahan fungsi insert pada Model `Mahasiswa`
* Proses penyimpanan data ke database

---

### 🧪 Hasil Pengujian

Pengujian dilakukan dengan mengakses URL:

```id="r6f2q1"
http://mvc_mahasiswa_kelompok5.test/mahasiswa/tambah
```

Langkah pengujian:

1. Mengisi form data mahasiswa
2. Menekan tombol submit
3. Sistem menyimpan data ke database
4. Data baru muncul pada tabel mahasiswa

Hasil:

* Data berhasil ditambahkan ke database
* Tidak terjadi error saat proses input
* Tampilan tabel berhasil diperbarui

---

### 📸 Dokumentasi Screenshot

#### 1. Form Tambah Mahasiswa

![Form](docs/sesi4_form.png)

#### 2. MahasiswaController (Method Tambah)

![Controller](docs/sesi4_controller.png)

#### 3. Model (Query Insert)

![Model](docs/sesi4_model.png)

#### 4. Hasil di Tabel

![Output](docs/sesi4_output.png)

---

### 🐛 Kendala yang Dihadapi

Beberapa kendala yang muncul:

* Method tidak ditemukan karena perbedaan nama URL
* Data tidak tersimpan akibat kesalahan query
* Input form tidak terbaca karena name tidak sesuai

---

### ✅ Solusi

* Menyesuaikan URL dengan method pada controller
* Memperbaiki query INSERT pada Model
* Menyamakan atribut `name` pada form dengan yang diproses di Controller

---

### 📌 Kesimpulan

Pada sesi ini, fitur penambahan data mahasiswa berhasil diimplementasikan dengan baik. Aplikasi sudah mampu menerima input dari user dan menyimpannya ke dalam database.

---

---

## 📘 Sesi 5 – Update dan Delete Data Mahasiswa

### 🎯 Tujuan Sesi

Pada sesi ini, kami mengimplementasikan fitur untuk mengubah (update) dan menghapus (delete) data mahasiswa. Dengan demikian, operasi CRUD (Create, Read, Update, Delete) pada aplikasi telah lengkap.

---

### 🧠 Konsep Dasar

#### ✏️ Update Data

```id="p3k9d2"
View (Form Edit) → Controller → Model → Database (UPDATE)
```

Penjelasan:

* User memilih data yang ingin diedit
* Data ditampilkan pada form edit
* Setelah diubah, data dikirim ke controller
* Model melakukan update ke database

---

#### 🗑️ Delete Data

```id="d7n2f1"
View (Tombol Delete) → Controller → Model → Database (DELETE)
```

Penjelasan:

* User menekan tombol delete
* Controller menerima ID data
* Model menghapus data dari database

---

### ⚙️ Implementasi

Pada sesi ini dilakukan:

* Penambahan tombol **Edit** dan **Delete** pada tabel mahasiswa
* Pembuatan method `edit()`, `update()`, dan `hapus()` pada `MahasiswaController`
* Pembuatan query `UPDATE` dan `DELETE` pada Model
* Pembuatan form edit untuk mengubah data

---

### 🧪 Hasil Pengujian

#### 🔹 Update Data

Langkah:

1. Klik tombol Edit
2. Mengubah data mahasiswa
3. Submit form

Hasil:

* Data berhasil diperbarui di database
* Perubahan langsung terlihat pada tabel

---

#### 🔹 Delete Data

Langkah:

1. Klik tombol Delete
2. Menghapus data

Hasil:

* Data berhasil dihapus dari database
* Data tidak lagi muncul di tabel

---

### 📸 Dokumentasi Screenshot

#### 1. Tombol Edit dan Delete pada Tabel

![Tombol](docs/sesi5_tombol.png)

#### 2. Form Edit Mahasiswa

![Form Edit](docs/sesi5_form_edit.png)

#### 3. Controller (Update & Delete)

Update
![Controller](docs/sesi5_method_update.png)

Delete
![Controller](docs/sesi5_method_delete.png)

#### 4. Hasil Update Data

![Update](docs/sesi5_update.png)

#### 5. Hasil Delete Data

![Delete](docs/sesi5_delete.png)

---

### 🐛 Kendala yang Dihadapi

Beberapa kendala yang muncul:

* Data tidak berubah karena query UPDATE tidak sesuai
* Data tidak terhapus karena ID tidak terbaca
* Kesalahan pengiriman data dari form ke controller

---

### ✅ Solusi

* Memastikan query UPDATE dan DELETE sesuai dengan struktur tabel
* Mengirim parameter ID dengan benar
* Menyesuaikan atribut `name` pada form dengan controller

---

### 📌 Kesimpulan

Pada sesi ini, fitur update dan delete data mahasiswa berhasil diimplementasikan. Aplikasi telah memiliki fitur CRUD lengkap dan siap untuk pengembangan lebih lanjut.

---
