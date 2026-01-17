<?php
session_start();
include 'connection.php';

$error = "";

if (isset($_POST['login'])) {
    $nis = (int)$_POST['nis'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_siswa']);

    // Mencocokkan NIS dan Nama di database
    $query = "SELECT * FROM siswa WHERE nis = '$nis' AND nama_siswa = '$nama'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        
        // Set Session untuk identitas user
        $_SESSION['login'] = true;
        $_SESSION['nis'] = $data['nis'];
        $_SESSION['nama'] = $data['nama_siswa'];

        // Redirect ke dashboard atau halaman utama
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "NIS atau Nama Siswa salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - AspiraSiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --tw-slate-900: #0f172a;
            --tw-slate-100: #f1f5f9;
            --tw-slate-600: #475569;
            --tw-blue-600: #2563eb;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--tw-slate-100);
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        .card-login {
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
        <div class="col-md-5 col-lg-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: var(--tw-slate-900);">Selamat Datang</h3>
                <p class="text-secondary">Masuk untuk menyampaikan aspirasimu</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2 small text-center" role="alert">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <div class="card card-login p-4 bg-white">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: var(--tw-slate-600);">NIS</label>
                        <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: var(--tw-slate-600);">Nama Lengkap</label>
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Masuk ke Platform</button>
                    <div class="text-center">
                        <span class="small text-secondary">Belum punya akun? <a href="register.php" class="text-decoration-none fw-bold" style="color: var(--tw-blue-600);">Daftar</a></span>
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