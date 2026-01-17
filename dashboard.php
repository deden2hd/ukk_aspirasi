<?php
session_start();

// Proteksi Halaman: Jika belum login, tendang balik ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - AspiraSiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --tw-slate-900: #0f172a;
            --tw-slate-100: #f1f5f9;
            --tw-blue-600: #2563eb;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--tw-slate-100);
        }
        .sidebar {
            background-color: white;
            min-height: 100vh;
            border-right: 1px solid #e2e8f0;
        }
        .nav-link {
            color: #64748b;
            font-weight: 500;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .nav-link.active {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--tw-blue-600);
        }
        .nav-link:hover:not(.active) {
            background-color: #f8fafc;
        }
        .main-content { padding: 2rem; }
        .card-stat {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar d-none d-md-block p-3">
            <h5 class="fw-bold mb-4 px-2" style="color: var(--tw-slate-900);">Aspira<span class="text-primary">Siswa.</span></h5>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#">Dashboard</a>
                <a class="nav-link" href="#">Aspirasi Saya</a>
                <a class="nav-link" href="#">Buat Laporan</a>
                <hr>
                <a class="nav-link text-danger" href="logout.php">Keluar</a>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 main-content">
            <header class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h4 class="fw-bold mb-0">Halo, <?php echo $_SESSION['nama']; ?>! 👋</h4>
                    <p class="text-secondary small">NIS: <?php echo $_SESSION['nis']; ?></p>
                </div>
                <div class="dropdown">
                    <button class="btn bg-white shadow-sm border rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['nama']; ?>&background=2563eb&color=fff" width="35" class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item py-2" href="logout.php text-danger">Logout</a></li>
                    </ul>
                </div>
            </header>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-stat p-4 bg-white text-center">
                        <p class="text-secondary small mb-1">Total Aspirasi</p>
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat p-4 bg-white text-center">
                        <p class="text-secondary small mb-1">Status Diproses</p>
                        <h2 class="fw-bold mb-0 text-warning">0</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat p-4 bg-white text-center">
                        <p class="text-secondary small mb-1">Selesai</p>
                        <h2 class="fw-bold mb-0 text-success">0</h2>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-5 bg-white rounded-4 border shadow-sm">
                <h5 class="fw-bold">Selamat datang di sistem aspirasi sekolah!</h5>
                <p class="text-secondary">Silahkan gunakan menu di samping untuk mulai menyampaikan keluhan, saran, atau ide kreatif kamu untuk kemajuan sekolah kita.</p>
                <button class="btn btn-primary px-4 mt-2" style="background-color: var(--tw-blue-600); border:none; border-radius:8px;">Buat Laporan Pertama</button>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>