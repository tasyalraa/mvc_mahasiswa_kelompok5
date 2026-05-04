<div class="container">
    <section class="py-4">
        <div class="p-4 rounded-4 shadow-sm bg-light border">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-primary mb-3 px-3 py-2">
                        Praktikum PHP MVC
                    </span>

                    <h1 class="h2 fw-bold mb-3">
                        Aplikasi Manajemen Data Mahasiswa
                    </h1>

                    <p class="text-secondary mb-3">
                        Sistem berbasis PHP MVC untuk mengelola data mahasiswa secara terstruktur,
                        mulai dari CRUD, pencarian, filter jurusan, hingga export laporan.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-primary px-4">
                            Lihat Data
                        </a>

                        <a href="<?= BASEURL; ?>/mahasiswa/create" class="btn btn-outline-primary px-4">
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="bg-white rounded-4 shadow-sm p-3 border">
                        <h6 class="fw-bold mb-2">Ringkasan Project</h6>

                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-secondary">Arsitektur</span>
                            <strong>MVC</strong>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-secondary">Bahasa</span>
                            <strong>PHP</strong>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-secondary">Database</span>
                            <strong>MySQL</strong>
                        </div>

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-secondary">Fitur</span>
                            <strong>CRUD + Export</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-2"
                             style="width: 36px; height: 36px;">
                            1
                        </div>
                        <h6 class="fw-bold">CRUD</h6>
                        <p class="text-secondary mb-0 small">
                            Tambah, tampil, edit, dan hapus data mahasiswa.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-3">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mb-2"
                             style="width: 36px; height: 36px;">
                            2
                        </div>
                        <h6 class="fw-bold">Search</h6>
                        <p class="text-secondary mb-0 small">
                            Cari data berdasarkan NPM atau nama mahasiswa.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-3">
                        <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center mb-2"
                             style="width: 36px; height: 36px;">
                            3
                        </div>
                        <h6 class="fw-bold">Filter</h6>
                        <p class="text-secondary mb-0 small">
                            Filter data mahasiswa berdasarkan jurusan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-3">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mb-2"
                             style="width: 36px; height: 36px;">
                            4
                        </div>
                        <h6 class="fw-bold">Export</h6>
                        <p class="text-secondary mb-0 small">
                            Export laporan mahasiswa ke CSV dan PDF.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>