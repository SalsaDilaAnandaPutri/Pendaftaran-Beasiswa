<?php
session_start();
session_destroy(); // Hapus semua sesi

header("Location: ../index.php"); // Redirect kembali ke halaman utama setelah logout
exit();
?>