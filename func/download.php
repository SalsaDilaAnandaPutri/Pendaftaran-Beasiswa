<?php
include 'db/koneksi.php'; // Menghubungkan ke database

// Periksa apakah nama file diatur dalam URL
if (isset($_GET['file'])) {
    // Sanitasi nama file untuk mencegah serangan directory traversal
    $filename = basename($_GET['file']); // Mendapatkan nama dasar untuk menghindari traversal path
    $file_path = '../../upload/' . $filename; // Sesuaikan path ini sesuai kebutuhan

    // Periksa apakah file ada
    if (file_exists($file_path)) {
        // Atur header untuk memulai pengunduhan file
        header('Content-Description: File Transfer'); // Deskripsi konten
        header('Content-Type: application/octet-stream'); // Tipe konten untuk pengunduhan
        header('Content-Disposition: attachment; filename="' . $filename . '"'); // Mengatur nama file saat diunduh
        header('Expires: 0'); // Tidak ada masa kadaluarsa
        header('Cache-Control: must-revalidate'); // Kontrol cache
        header('Pragma: public'); // Kontrol akses publik
        header('Content-Length: ' . filesize($file_path)); // Menyertakan ukuran file

        // Bersihkan buffer output sebelum membaca file
        ob_clean(); // Membersihkan output buffer
        flush(); // Mengeluarkan buffer output
        readfile($file_path); // Membaca dan mengirim file ke output
        exit; // Hentikan eksekusi lebih lanjut
    } else {
        // Menampilkan alert jika file tidak ditemukan
        echo "<script>alert('File tidak ditemukan.'); window.location.href='../hasil.php';</script>"; 
    }
} else {
    // Menampilkan alert jika nama file tidak ditentukan
    echo "<script>alert('Nama file tidak ditentukan.'); window.location.href='../hasil.php';</script>"; 
}
?>
