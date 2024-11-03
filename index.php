<?php
session_start(); // Memulai sesi untuk pengguna

// Koneksi ke database
include 'db/koneksi.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['nama'])) {
    header("Location: page/beranda.php"); // Mengarahkan pengguna yang sudah login
    exit(); // Menghentikan eksekusi script setelah redirect
}

// Proses login jika method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan sanitasi input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Menghapus karakter yang tidak perlu dari email
    $password = $_POST['password']; // Mengambil password yang dimasukkan

    // Ambil data pengguna dari database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); // Menyiapkan query untuk mencegah SQL injection
    $stmt->bind_param("s", $email); // Mengikat parameter email
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil

    if ($result->num_rows > 0) { // Memeriksa jika pengguna ditemukan
        $user = $result->fetch_assoc(); // Mengambil data pengguna
        // Verifikasi password
        if (password_verify($password, $user['password'])) { // Memeriksa kecocokan password
            // Set session
            $_SESSION['nama'] = $user['nama']; // Menyimpan nama pengguna dalam sesi
            header("Location: page/beranda.php"); // Redirect ke dashboard setelah login berhasil
            exit(); // Menghentikan eksekusi script setelah redirect
        } else {
            $error = "Password salah."; // Pesan kesalahan jika password salah
        }
    } else {
        $error = "Pengguna tidak ditemukan."; // Pesan kesalahan jika pengguna tidak ada
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="asset/css/style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Warna tema utama */
        .bg-custom { background-color: #b6252a; }
        .text-custom { color: #b6252a; }
        .btn-custom { background-color: #b6252a; color: #fff; border: none; }
        .btn-custom:hover { background-color: #a52227; }
        
        /* Styling untuk Form */
        .form-container {
            max-width: 450px; /* Lebar maksimum form */
            margin: auto; /* Memusatkan form */
            padding: 30px; /* Padding dalam form */
            border-radius: 8px; /* Sudut melengkung untuk form */
            background: #ffffff; /* Warna latar belakang form */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Bayangan di sekitar form */
        }
        
        /* Styling untuk Footer */
        footer { margin-top: 50px; padding: 15px 0; }
    </style>
</head>

<body class="bg-light d-flex flex-column align-items-center" style="min-height: 100vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h1 class="text-center text-custom mb-3">Sistem Pendaftaran Beasiswa</h1>
                    <h2 class="text-center text-secondary mb-4">Login Akun</h2>
                    <?php if (isset($error)): ?> <!-- Menampilkan pesan kesalahan jika ada -->
                        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST" class="mb-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required> <!-- Input email -->
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" required> <!-- Input password -->
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Login</button> <!-- Tombol untuk login -->
                    </form>

                    <div class="text-center">
                        <p>Belum punya akun? <a href="register.php" class="text-decoration-none text-custom">Daftar di sini</a></p> <!-- Tautan untuk registrasi -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-custom text-white text-center py-3 w-100 mt-4">
        <div class="container">
            <p class="mb-1">&copy; 2024 Pendaftaran Beasiswa. All Rights Reserved.</p>
            <p>Hubungi Kami di:
                <a href="https://www.facebook.com/salsadila/" class="text-white text-decoration-none">Facebook</a> |
                <a href="mailto:salsadila@example.com" class="text-white text-decoration-none">Email</a> |
                <a href="https://www.instagram.com/salsadila/" class="text-white text-decoration-none">Instagram</a>
            </p>
        </div>
    </footer>
</body>
</html>
