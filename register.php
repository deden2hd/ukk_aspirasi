<?php
include 'connection.php';
$msg = ""; // Inisialisasi variabel agar tidak error saat halaman pertama dimuat

if (isset($_POST['register'])) {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_siswa']);

    // 1. Cek apakah NIS sudah ada
    $cek = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");
    
    if (mysqli_num_rows($cek) > 0) {
        $msg = ["danger", "NIS <strong>$nis</strong> sudah terdaftar!"];
    } else {
        // 2. Jika belum ada, masukkan data
        $query = "INSERT INTO siswa (nis, nama_siswa) VALUES ('$nis', '$nama')";
        if (mysqli_query($conn, $query)) {
            $msg = ["success", "Registrasi berhasil! Silahkan <a href='login.php' class='alert-link'>Login</a>"];
        } else {
            $msg = ["danger", "Gagal menyimpan data."];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - AspiraSiswa</title>
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
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        .card-register {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .form-control:focus {
            border-color: var(--tw-blue-600);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .btn-primary {
            background-color: var(--tw-blue-600);
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: var(--tw-slate-900);">Mulai Aspirasimu</h3>
                <p class="text-secondary">Daftarkan NIS kamu untuk mulai melapor</p>
            </div>

            <?php if ($msg): ?>
                <div class="alert alert-<?= $msg[0]; ?> alert-dismissible fade show shadow-sm" role="alert">
                    <?= $msg[1]; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card card-register p-4 bg-white">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Induk Siswa (NIS)</label>
                        <input type="number" name="nis" class="form-control" placeholder="Contoh: 2223101" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100 mb-3 text-white">Daftar Akun</button>
                    <div class="text-center">
                        <span class="small text-secondary">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold" style="color: var(--tw-blue-600);">Masuk</a></span>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-4">
                <a href="index.php" class="text-secondary text-decoration-none small">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>