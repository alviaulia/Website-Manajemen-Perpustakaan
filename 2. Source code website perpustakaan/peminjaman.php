<?php
// Mulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('connect.php');

// Pastikan user_id sudah tersedia dari sesi sebelumnya
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Menghitung jumlah data di tabel transaksi_pinjam
    $query_transaksi = "SELECT COUNT(*) as count FROM transaksi_peminjaman WHERE id_anggota = $user_id";
    $result_transaksi = $connect->query($query_transaksi);
    $row_transaksi = $result_transaksi->fetch_assoc();
    $count_transaksi = $row_transaksi['count'];

    // Menghitung jumlah data di tabel buku
    $query_buku = "SELECT COUNT(*) as count FROM buku";
    $result_buku = $connect->query($query_buku);
    $row_buku = $result_buku->fetch_assoc();
    $count_buku = $row_buku['count'];

    // Menghitung jumlah data di tabel anggota
    $query_anggota = "SELECT COUNT(*) as count FROM anggota";
    $result_anggota = $connect->query($query_anggota);
    $row_anggota = $result_anggota->fetch_assoc();
    $count_anggota = $row_anggota['count'];
} else {
    // Jika user_id tidak tersedia, lakukan tindakan yang sesuai (misalnya, arahkan pengguna ke halaman login)
    header("Location: login.php");
    exit(); // Pastikan untuk menghentikan eksekusi script setelah pengalihan
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .switch-container {
            width: 460px;
            height: 50px;
            margin: 0 auto;
            position: relative;
            display: flex;
            background: #D2D2D2;
            border-radius: 25px;
        }

        .switch-button {
            width: 43.33%;
            height: 100%;
            text-align: center;
            line-height: 50px;
            font-size: 18px;
            font-family: Poppins, sans-serif;
            font-weight: 400;
            cursor: pointer;
            position: relative;
            z-index: 1;
            transition: color 0.3s;
            color: black;
        }

        .switch-button a {
            color: inherit;
            text-decoration: none;
        }

        .switch-button.active {
            color: white;
        }

        .switch-toggle {
            width: 33.33%;
            height: 100%;
            background: #4159AF;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 25px;
            transition: left 0.3s;
            z-index: 0;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<?php

include 'navu.php';

    ?>




    <main class="p-5 mt-5">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">



                        <div class="card-body">
                            <h5 class="card-title">Anggota <span>| Jumlah Anggota</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-user-follow-line"></i>
                                </div>


                                <div class="ps-3">
                                    <h6><?php echo $count_anggota ?></h6>

                                </div>

                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Buku <span>| Jumlah Buku</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-book-line"></i>

                                </div>
                                <div class="ps-3">


                                    <h6><?php echo $count_buku ?></h6>


                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Peminjaman <span>| Jumlah Peminjaman</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-exchange-line"></i>

                                </div>
                                <div class="ps-3">


                                    <h6><?php echo $count_transaksi ?></h6>


                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->

                <!-- Reports -->
                <div class="col-12">

                </div><!-- End Reports -->
                <div class="switch-container">
                    <div class="switch-button" data-active="dashboarduser">
                        <a href="dashboarduser.php">Buku</a>
                    </div>
                    <div class="switch-button" data-active="peminjaman">
                        <a href="peminjaman.php">Peminjaman</a>
                    </div>
                    <div class="switch-button" data-active="daftarkembali">
                        <a href="daftarkembali.php">Pengembalian</a>
                    </div>
                    <div class="switch-toggle"></div>
                </div>


                <script>
                    document.querySelectorAll('.switch-button').forEach(button => {
                        button.addEventListener('click', function() {
                            document.querySelectorAll('.switch-button').forEach(btn => btn.classList.remove('active'));
                            this.classList.add('active');

                            const activeType = this.getAttribute('data-active');
                            document.querySelector('.switch-toggle').style.left = {
                                'dashboarduser': '0',
                                'peminjaman': '33.33%',
                                'daftarkembali': '66.66%'
                            } [activeType];
                        });
                    });

                    // Set the default active button based on the current URL
                    const url = window.location.pathname;
                    if (url.includes('dashboarduser.php')) {
                        document.querySelector('.switch-button[data-active="dashboarduser"]').classList.add('active');
                        document.querySelector('.switch-toggle').style.left = '0';
                    } else if (url.includes('peminjaman.php')) {
                        document.querySelector('.switch-button[data-active="peminjaman"]').classList.add('active');
                        document.querySelector('.switch-toggle').style.left = '33.33%';
                    } else if (url.includes('daftarkembali.php')) {
                        document.querySelector('.switch-button[data-active="daftarkembali"]').classList.add('active');
                        document.querySelector('.switch-toggle').style.left = '66.66%';
                    }
                </script>

                <div class="col-12" style="height: 50px">

                </div><!-- End Reports -->
                <!-- Recent Sales -->

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Jadwal</h5>

                            <!-- Table with stripped rows -->
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Jatuh Tempo</th>
                                        <th>Nama Anggota</th>
                                        <th>Nama Buku</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                     
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $query = "
                                    SELECT 
                                        tp.id_transaksi_peminjaman, 
                                        tp.tgl_peminjaman, 
                                        tp.tanggal_jatuh_tempo, 
                                        tp.id_anggota, 
                                        a.nama_anggota, 
                                        tp.id_buku, 
                                        b.judul_buku, 
                                        tp.id_pustakawan, 
                                        tp.qty,
                                        CASE
                                            WHEN tp.id_transaksi_peminjaman IN (SELECT id_transaksi_peminjaman FROM transaksi_pengembalian) THEN 'Sudah Dikembalikan'
                                            ELSE 'Belum Dikembalikan'
                                        END AS status
                                    FROM 
                                        transaksi_peminjaman tp
                                    JOIN 
                                        anggota a ON tp.id_anggota = a.id_anggota
                                    JOIN 
                                        buku b ON tp.id_buku = b.id_buku
                                    WHERE tp.id_anggota = $user_id
                                ";
                                    $result = $connect->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['id_transaksi_peminjaman'] ?></td>
                                                <td><?php echo $row['tgl_peminjaman'] ?></td>
                                                <td><?php echo $row['tanggal_jatuh_tempo'] ?></td>
                                                <td><?php echo $row['nama_anggota'] ?></td>
                                                <td><?php echo $row['judul_buku'] ?></td>

                                                <td><?php echo $row['qty'] ?></td>
                                                <td><?php echo $row['status'] ?></td>



                                              
                                            </tr>
                                    <?php }
                                    } ?>

                                </tbody>

                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>


        </section>
     

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Menangani klik pada tombol "Hapus"
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-presensi');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const presensiId = this.getAttribute('data-presensi-id');
                    // Menampilkan sweet alert
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oke, hapus saja!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika tombol "Oke" diklik, menuju ke route delete-presensi dengan ID presensi
                            window.location.href = `/delete-presensi/${presensiId}`;
                        }
                    });
                });
            });
        });
    </script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        function updateClock() {
            var now = new Date();
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);
            var seconds = ('0' + now.getSeconds()).slice(-2);
            var day = now.toLocaleDateString('en-US', {
                weekday: 'long'
            });
            var date = ('0' + now.getDate()).slice(-2);
            var month = now.toLocaleDateString('en-US', {
                month: 'long'
            });
            var year = now.getFullYear();

            document.getElementById('clock').textContent = hours + ':' + minutes + ':' + seconds + ' | ' + day + ', ' +
                date + ' ' + month + ' ' + year;
        }

        setInterval(updateClock, 1000); // Update setiap detik
    </script>
    <script>
        function submitForm() {
            document.getElementById("updateForm").submit();
        }
    </script>

</body>

</html>