<?php
// koneksi.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pendaftaran_beasiswa";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);


// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>