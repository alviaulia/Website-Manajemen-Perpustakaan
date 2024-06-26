<?php

include('connect.php');

// Menghitung jumlah data di tabel transaksi_pinjam
$query_transaksi = "SELECT COUNT(*) as count FROM transaksi_peminjaman";
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

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('.datatable').DataTable();

            // Tambahkan event listener untuk input pencarian
            $('#search').on('keyup', function() {
                $('.datatable').DataTable().search($(this).val()).draw();
            });
        });
    </script>


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

include 'nav.php';

    ?>




    <main class="p-5 mt-5">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <!-- Search Input -->

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
                    <div class="switch-button" data-active="dashboardadmin">
                        <a href="dashboardadmin.php">Peminjaman</a>
                    </div>
                    <div class="switch-button" data-active="buku">
                        <a href="buku.php">Buku</a>
                    </div>
                    <div class="switch-button" data-active="pengembalian">
                        <a href="pengembalian.php">Pengembalian</a>
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
                                'dashboardadmin': '0',
                                'buku': '33.33%',
                                'pengembalian': '66.66%'
                            } [activeType];
                        });
                    });

                    // Set the default active button based on the current URL
                    const url = window.location.pathname;
                    if (url.includes('dashboardadmin.php')) {
                        document.querySelector('.switch-button[data-active="dashboardadmin"]').classList.add('active');
                        document.querySelector('.switch-toggle').style.left = '0';
                    } else if (url.includes('buku.php')) {
                        document.querySelector('.switch-button[data-active="buku"]').classList.add('active');
                        document.querySelector('.switch-toggle').style.left = '33.33%';
                    } else if (url.includes('pengembalian.php')) {
                        document.querySelector('.switch-button[data-active="pengembalian"]').classList.add('active');
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
                            <div class="col-lg-4">
                            <input type="text" id="searchInput"  class="form-control" style="border-color: black;" placeholder="Cari berdasarkan judul buku">
                            </div>

                            <!-- Table with stripped rows -->
                            <script>
    // Fungsi untuk mencari dan menyaring data tabel berdasarkan inputan pengguna
    function searchTable() {
        const input = document.getElementById('searchInput').value.toLowerCase(); // Ambil nilai inputan dan ubah menjadi huruf kecil
        const rows = document.querySelectorAll('.datatables tbody tr'); // Ambil semua baris dalam tabel

        rows.forEach(row => {
            const judulBuku = row.children[1].textContent.toLowerCase(); // Ambil judul buku dari setiap baris dan ubah menjadi huruf kecil
            const penulisBuku = row.children[2].textContent.toLowerCase(); // Ambil penulis buku dari setiap baris dan ubah menjadi huruf kecil
            if (judulBuku.includes(input) || penulisBuku.includes(input)) { // Periksa apakah judul atau penulis buku mengandung inputan pengguna
                row.style.display = ''; // Jika ya, tampilkan baris
            } else {
                row.style.display = 'none'; // Jika tidak, sembunyikan baris
            }
        });
    }

    // Tambahkan event listener untuk inputan pencarian yang memanggil fungsi pencarian saat inputan berubah
    document.getElementById('searchInput').addEventListener('input', searchTable);
</script>

                            <table class="table datatables">
                                <thead>
                                    <tr>
                                        <th>ID Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Penulis</th>
                                        <th>Stok Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('connect.php');

                                    $query = "SELECT * FROM buku";
                                    $result = $connect->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['id_buku']; ?></td>
                                                <td><?php echo $row['judul_buku']; ?></td>
                                                <td><?php echo $row['penulis']; ?></td>
                                                <td><?php echo $row['stok_buku']; ?></td>




                                                <td>


                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_buku']; ?>">
                                                        <i class="bi bi-pencil" style="color: black; font-size: 20px;"></i>
                                                    </a>
                                                    <!-- Modal Edit Data -->
                                                    <div class="modal fade" id="editModal<?php echo $row['id_buku']; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Formulir -->
                                                                    <form action="update_buku.php" method="POST">
                                                                        <input type="hidden" value="<?php echo $row['id_buku']; ?>" name="id_buku" ?>
                                                                        <div class="row mb-3">
                                                                            <label for="inputText" class="col-sm-2 col-form-label">Judul Buku</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" class="form-control" name="judul_buku" id="inputText" value="<?php echo $row['judul_buku']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label for="inputText" class="col-sm-2 col-form-label">Penulis</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" class="form-control" name="penulis" id="inputText" value="<?php echo $row['penulis']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label for="inputText" class="col-sm-2 col-form-label">Stok Buku</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="number" class="form-control" name="stok_buku" id="inputText" value="<?php echo $row['stok_buku']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary" style="background-color: #4159AF;">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <!-- Tautan tanda sampah -->
                                                    <a href="delete_buku.php?id_buku=<?php echo $row['id_buku']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                                        <i class="bi bi-trash" style="color: black; font-size: 20px;"></i>
                                                    </a>


                                                </td>
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
        <a href="#" data-bs-toggle="modal" data-bs-target="#adddata">
            <div style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; background: #4159AF; border-radius: 50%; text-align: center;">
                <i class="bi bi-plus-lg" style="font-size: 35px; font-weight: bold; color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
            </div>
        </a>

        <div class="modal fade" id="adddata" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="add_buku.php" method="POST">

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Judul Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul_buku" id="inputText" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Penulis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="penulis" id="inputText" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Stok Buku</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="stok_buku" id="inputText" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #4159AF;">Tambah</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>





    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>


    <script>
        function submitForm() {
            document.getElementById("updateForm").submit();
        }
    </script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>