<?php
// Menghubungkan ke database
include 'db/koneksi.php';

// Memeriksa apakah ada permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil dan membersihkan input dari form
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mengamankan password

    // Memeriksa apakah email sudah terdaftar
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows == 0) {
        // Menyimpan data pengguna baru ke database
        $conn->query("INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')");
        $message = "Pendaftaran berhasil! Silakan <a href='index.php'>Login</a>";
        $message_type = "success"; // Tipe pesan berhasil
    } else {
        $message = "Email sudah terdaftar."; // Pesan jika email sudah ada
        $message_type = "error"; // Tipe pesan error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Pendaftaran Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Warna tema utama */
        .bg-custom { background-color: #b6252a; }
        .text-custom { color: #b6252a; }
        .btn-custom { background-color: #b6252a; color: #fff; border: none; }
        .btn-custom:hover { background-color: #a52227; }
        
        /* Styling untuk Form dan Notifikasi */
        .form-container {
            max-width: 450px; /* Maksimal lebar form */
            margin: auto; /* Tengah form */
            padding: 30px; /* Padding dalam form */
            border-radius: 8px; /* Sudut melengkung */
            background: #ffffff; /* Latar belakang form */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Bayangan form */
        }
        .notification.success { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .notification.error { background-color: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        
        /* Styling Footer */
        footer { margin-top: 50px; padding: 15px 0; }
    </style>
</head>

<body class="bg-light d-flex flex-column align-items-center" style="min-height: 100vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h1 class="text-center text-custom mb-3">Sistem Pendaftaran Beasiswa</h1>
                    <h2 class="text-center text-secondary mb-4">Registrasi Akun</h2>

                    <?php if (isset($message)): ?>
                        <div class="notification <?= $message_type ?>"> <!-- Menampilkan notifikasi -->
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-custom w-100">Daftar</button> <!-- Tombol untuk submit form -->
                    </form>

                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="index.php" class="text-custom text-decoration-none">Login di sini</a></p>
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

    <script>
        // Mengatur tampilan notifikasi setelah beberapa detik
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($message)): ?>
                setTimeout(() => {
                    document.querySelector('.notification').style.display = 'none'; // Menyembunyikan notifikasi setelah 5 detik
                }, 5000);
            <?php endif; ?>
        });
    </script>
</body>
</html>

