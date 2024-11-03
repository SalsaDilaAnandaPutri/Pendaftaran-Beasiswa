<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Aturan penulisan HTML dasar -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>

    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="../asset/css/style.css"> 
    <link rel="stylesheet" href="../asset/css/beranda.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Definisi gaya CSS dalam elemen <style> -->
    <style>
        body {
            background-color: #f4f4f4;
        }

        .scholarship-section {
            padding: 40px 20px;
            margin: auto;
            max-width: 1200px;
        }

        .scholarship-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .scholarship-type {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            transition: transform 0.3s;
        }

        .scholarship-type:hover {
            transform: scale(1.02);
        }

        .scholarship-image {
            width: 350px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
        }

        .requirements {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }

        .requirements.show {
            max-height: 200px;
        }

        .btn-detail {
            background-color: #b6252a;
            color: white;
            border: none;
            transition: background-color 0.3s;
            width: 150px;
        }

        .btn-detail:hover {
            background-color: #a01924;
        }
    </style>
</head>
<body>
    <!-- Bagian Navbar -->
    <nav>
        <div class="container">
            <h2>Pendaftaran Beasiswa</h2>
            <ul>
                <li><a href="beranda.php">Pilihan Beasiswa</a></li>
                <li><a href="daftar.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../func/logout.php">Logout Akun</a></li>
            </ul>
        </div>
    </nav>

    <?php session_start(); ?>

    <div class="scholarship-section">
        <div class="scholarship-header">
            <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h1>
            <h2>Jenis Beasiswa dan Ketentuan</h2>
        </div>

        <div class="scholarship-types">
            <!-- Beasiswa Akademik -->
            <div class="scholarship-type">
                <img src="../asset/img/akademikk.jpg" alt="Beasiswa Akademik" class="scholarship-image">
                <div>
                    <h3>Beasiswa Akademik</h3>
                    <p><strong>Syarat:</strong> IPK minimal 3.0, Menjuarai perlombaan bidang Akademik.</p>
                    <button class="btn btn-detail" onclick="toggleRequirements('req-akademik')">Lihat Detail</button>
                    <div id="req-akademik" class="requirements">
                        <p><strong>Dokumen yang Diperlukan:</strong></p>
                        <ul>
                            <li>Fotokopi transkrip nilai terbaru</li>
                            <li>Fotokopi KTM (Kartu Tanda Mahasiswa)</li>
                            <li>Surat pernyataan tidak menerima beasiswa lain</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Beasiswa Non-Akademik -->
            <div class="scholarship-type">
                <img src="../asset/img/nonakademik.jpg" alt="Beasiswa Non-Akademik" class="scholarship-image">
                <div>
                    <h3>Beasiswa Non-Akademik</h3>
                    <p><strong>Syarat:</strong> IPK minimal 3.0, Menjuarai perlombaan bidang Non-Akademik.</p>
                    <button class="btn btn-detail" onclick="toggleRequirements('req-nonakademik')">Lihat Detail</button>
                    <div id="req-nonakademik" class="requirements">
                        <p><strong>Dokumen yang Diperlukan:</strong></p>
                        <ul>
                            <li>Fotokopi KTM</li>
                            <li>Fotokopi sertifikat juara</li>
                            <li>Surat keterangan aktif dalam organisasi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Beasiswa Kepemimpinan -->
            <div class="scholarship-type">
                <img src="../asset/img/kepemimpinan.jpg" alt="Beasiswa Kepemimpinan" class="scholarship-image">
                <div>
                    <h3>Beasiswa Kepemimpinan</h3>
                    <p><strong>Syarat:</strong> IPK minimal 3.0, Pemimpin organisasi kemahasiswaan, Prestasi dalam program kerja.</p>
                    <button class="btn btn-detail" onclick="toggleRequirements('req-kepemimpinan')">Lihat Detail</button>
                    <div id="req-kepemimpinan" class="requirements">
                        <p><strong>Dokumen yang Diperlukan:</strong></p>
                        <ul>
                            <li>Fotokopi KTM</li>
                            <li>Surat keterangan jabatan</li>
                            <li>Laporan kegiatan organisasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Grafik -->
        <div class="container mt-5">
            <h3 class="text-center">Grafik Jumlah Penerima Beasiswa Tahun 2022-2024</h3>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <canvas id="beasiswaChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Bagian JavaScript -->
    <script>
    // Fungsi untuk toggle tampilan persyaratan
    function toggleRequirements(reqId) {
        const requirements = document.getElementById(reqId);
        requirements.classList.toggle('show');
    }

    // Grafik menggunakan Chart.js
    const ctx = document.getElementById('beasiswaChart').getContext('2d');
    const beasiswaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2022', '2023', '2024'],
            datasets: [
                {
                    label: 'Beasiswa Akademik',
                    data: [20, 30, 40],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderWidth: 1
                },
                {
                    label: 'Beasiswa Non-Akademik',
                    data: [15, 25, 35],
                    backgroundColor: 'rgba(255, 206, 86, 0.7)',
                    borderWidth: 1
                },
                {
                    label: 'Beasiswa Kepemimpinan',
                    data: [10, 20, 30],
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Penerima Beasiswa',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penerima',
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun',
                    }
                }
            }
        }
    });
    </script>
</body>
</html>
