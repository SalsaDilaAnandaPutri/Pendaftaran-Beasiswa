<?php
// Menghubungkan ke database
include '../db/koneksi.php';

// Mengambil semua data pendaftaran dari database
$query = "SELECT * FROM daftar"; // Sesuaikan query ini jika perlu memfilter berdasarkan pengguna
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran Beasiswa</title>
    
    <!-- Menghubungkan ke CSS lokal dan CDN -->
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/daftar.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
            <h2>Hasil Pendaftaran Beasiswa</h2>
            <ul>
                <li><a href="beranda.php">Pilihan Beasiswa</a></li>
                <li><a href="daftar.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../func/logout.php">Logout Akun</a></li>
            </ul>
        </div>
    </nav>

    <!-- Bagian Hasil Pendaftaran -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Daftar Pendaftaran Beasiswa</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Semester</th>
                    <th>IPK Terakhir</th>
                    <th>Pilihan Beasiswa</th>
                    <th>Berkas Syarat</th>
                    <th>Status Ajuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Memeriksa apakah ada hasil dan menampilkannya
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { // Looping untuk setiap baris data
                        echo "<tr>
                                <td>" . htmlspecialchars($row['nama']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['no_hp']) . "</td>
                                <td>" . htmlspecialchars($row['semester']) . "</td>
                                <td>" . htmlspecialchars($row['last_ipk']) . "</td>
                                <td>" . htmlspecialchars($row['beasiswa']) . "</td>                        
                                <td class='text-center'><a href='/Serkom/Pendaftaran Beasiswa/upload/" . htmlspecialchars($row['syarat_berkas']) . "' target='_blank'><i class='fas fa-download'></i> Download</a></td>
                                <td>";

                        // Menentukan status ajuan
                        echo ($row["status_ajuan"] == '1') ? "Sudah terverifikasi" : "Belum diverifikasi";

                        echo "</td></tr>";
                    }
                } else {
                    // Jika tidak ada data, tampilkan pesan
                    echo "<tr><td colspan='8' class='text-center'>Belum ada pendaftaran</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- CSS Kustom -->
<style>
    .bg-custom {
        background-color: #b6252a; /* Warna background khusus */
    }
</style>

<!-- Footer -->
<footer class="bg-custom text-white text-center py-3">
    <div class="container">
        <p>&copy; 2024 Pendaftaran Beasiswa. All Rights Reserved.</p>
        <p>Hubungi Kami di:
            <a href="https://www.facebook.com/salsadila/" class="text-white">Facebook</a> |
            <a href="mailto:salsadila@example.com" class="text-white">Email</a> |
            <a href="https://www.instagram.com/salsadila/" class="text-white">Instagram</a>
        </p>
    </div>
</footer>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
