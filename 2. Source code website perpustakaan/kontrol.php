<?php
include('connect.php');

// Mulai sesi
session_start();

// Periksa apakah session 'user_id' tidak kosong
if (empty($_SESSION['user_id'])) {
  // Jika session 'user_id' kosong, redirect ke halaman login.php
  header("Location: login.php");
  exit(); // Penting untuk menghentikan eksekusi skrip setelah redirect
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
if($row['foto'] == null){
  $foto = 'https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png';
}else{
$foto = $row['foto'];
}
$nama = $row['nama'];
$username = $row['username'];
$email = $row['email'];

// Skrip PHP lainnya di sini


function getStatus()
{
  global $connect;
  $sql = "SELECT status FROM isvalue"; // Ubah nama_tabel dan kolom sesuai struktur tabel Anda
  $result = $connect->query($sql);

  if ($result->num_rows > 0) {
    // Mengambil baris hasil
    $row = $result->fetch_assoc();
    $status = $row["status"];
  } else {
    // Jika tidak ada hasil yang ditemukan, set status ke default (0)
    $status = 0;
  }

  return $status;
}

// Function to update the status in the database
function updateStatus($newStatus)
{
  // Add your SQL query to update the status here
  $sql = "UPDATE isvalue SET status = $newStatus";
  global $connect; // Assuming $connect is your database connection variable
  if (mysqli_query($connect, $sql)) {
    // Status updated successfully
    return true;
  } else {
    // Error occurred while updating the status
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    return false;
  }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the current status
  $status = getStatus();
  $iconColor = ($status == 0) ? "red" : "green";
  // Toggle the status
  $newStatus = ($status == 0) ? 1 : 0;

  // Update the status in the database
  if (updateStatus($newStatus)) {
    // Redirect back to the page or perform any other actions
    header("Location: index.php");
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kontrol</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #4159AF; color: white;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span style="font-size: 16px; color: white;">Catfish <br /> Automatic <br /> Feeder</span>

      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="color: white;"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <!-- End Notification Nav -->



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $foto?>" alt="Profile" class="rounded-circle" style="background-color: white;" >
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;"><?php echo $username?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $nama?></h6>
              <span><?php echo $email?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="login.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" style="background-color: #4159AF;">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home Page</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link " href="kontrol.php">
          <i class="bi bi-layout-text-window-reverse"></i><span>Kontrol</span></i>
        </a>

      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pencatatan.php">
          <i class="bi bi-bar-chart"></i><span>Pecatatan</span></i>
        </a>

      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pemantauan.php">
          <i class="bi bi-eyeglasses"></i><span>Pematauan</span></i>
        </a>

      </li><!-- End Charts Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

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
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Jadwal <span>| Hari Ini</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-day"></i>
                    </div>
                    <?php
                     // Query untuk menghitung total jumlah data pada hari ini
                     $totalQuery = "SELECT COUNT(*) AS total FROM jadwal WHERE tanggal = CURDATE()";
                     $totalResult = mysqli_query($connect, $totalQuery);
                     $totalRow = mysqli_fetch_assoc($totalResult);
                     $totalCount = $totalRow['total'];
                    // Query untuk menghitung jumlah data yang statusnya 'Selesai' pada hari ini
                    $completedQuery = "SELECT COUNT(*) AS completed FROM jadwal WHERE tanggal = CURDATE() AND status = 'Selesai'";
                    $completedResult = mysqli_query($connect, $completedQuery);
                    $completedRow = mysqli_fetch_assoc($completedResult);
                    $completedCount = $completedRow['completed'];

                   

                    // Hitung persentase
                    $percentage = ($totalCount > 0) ? ($completedCount / $totalCount) * 100 : 0;
                    ?>

                    <div class="ps-3">
                      <h6><?php echo $totalCount; ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo number_format($percentage); ?>%</span>
                      <span class="text-muted small pt-2 ps-1">Terlaksana</span>
                    </div>

                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">



                <div class="card-body">
                  <h5 class="card-title">Daftar <span>| Jadwal</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-week"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                     // Query untuk menghitung total jumlah data pada hari ini
                     $totalQuery = "SELECT COUNT(*) AS total FROM jadwal";
                     $totalResult = mysqli_query($connect, $totalQuery);
                     $totalRow = mysqli_fetch_assoc($totalResult);
                     $totalCount = $totalRow['total'];
                    // Query untuk menghitung jumlah data yang statusnya 'Selesai' pada hari ini
                    $completedQuery = "SELECT COUNT(*) AS completed FROM jadwal WHERE tanggal = CURDATE()";
                    $completedResult = mysqli_query($connect, $completedQuery);
                    $completedRow = mysqli_fetch_assoc($completedResult);
                    $completedCount = $completedRow['completed'];



                    // Hitung persentase
                    $percentage = ($totalCount > 0) ? ($completedCount / $totalCount) * 100 : 0;
                    ?>

                      <h6><?php echo $totalCount; ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo number_format($percentage); ?>%</span> <span class="text-muted small pt-2 ps-1">Hari Ini</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">



                <div class="card-body">
                  <h5 class="card-title">Riwayat <span>| Pemberian</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                     // Query untuk menghitung total jumlah data pada hari ini
                     $totalQuery = "SELECT COUNT(*) AS total FROM jadwal WHERE status = 'Selesai'";
                     $totalResult = mysqli_query($connect, $totalQuery);
                     $totalRow = mysqli_fetch_assoc($totalResult);
                     $totalCount = $totalRow['total'];
                    // Query untuk menghitung jumlah data yang statusnya 'Selesai' pada hari ini
                    $completedQuery = "SELECT COUNT(*) AS completed FROM jadwal ";
                    $completedResult = mysqli_query($connect, $completedQuery);
                    $completedRow = mysqli_fetch_assoc($completedResult);
                    $completedCount = $completedRow['completed'];

                   

                    // Hitung persentase
                    $percentage = ($totalCount > 0) ? ( $totalCount / $completedCount) * 100 : 0;
                    ?>

                      <h6><?php echo $totalCount; ?></h6>
                      <span class="text-danger small pt-1 fw-bold"><?php echo number_format($percentage); ?>%</span> <span class="text-muted small pt-2 ps-1">Dari Jadwal</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">

            </div><!-- End Reports -->

            <!-- Recent Sales -->
           
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Jadwal</h5>
              <div class="text-center" style="width: 241px; height: 37px; position: relative; left: 50%; transform: translateX(-50%);">
                <div style="width: 241px; height: 37px; left: 0px; top: 0px; position: absolute; background: #D2D2D2; border-radius: 30px"></div>
                <a href="riwayat.php">
                  <div style="left: 152px; top: 6px; position: absolute; color: black; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Riwayat</div>
                </a>
                <div style="width: 115px; height: 37px; left: 0px; top: 0px; position: absolute">
                  <div style="width: 115px; height: 37px; left: 0px; top: 0px; position: absolute; background: #4159AF; border-radius: 30px"></div>
                  <div style="left: 29px; top: 6px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Jadwal</div>
                </div>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">


                <thead>
                  <tr>
                    <th>No </th>
                    <th>ID </th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM `jadwal` WHERE status = 'Belum' ORDER BY id DESC";
                  $result = mysqli_query($connect, $sql);
                  // Query untuk menghitung jumlah baris
                  $countQuery = "SELECT COUNT(*) AS total FROM jadwal";
                  $countResult = mysqli_query($connect, $countQuery);
                  $countRow = mysqli_fetch_assoc($countResult);
                  $jumlah_baris = $countRow['total'];

                  $no = 1; // Nomor urut awal
                  if (mysqli_num_rows($result) > 0) {
                    // Jika terdapat data yang ditemukan
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['waktu']; ?></td>
                        <td><?php echo $row['durasi']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                          <a type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered<?php echo $row['id']; ?>">
                            <i class="bi bi-pencil" style="color: black; font-size: 20px;"></i>
                          </a>
                          <div class="modal fade" id="verticalycentered<?php echo $row['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <!-- Formulir -->
                                  <form action="update.php" method="post">
                                    <div class="row mb-3">
                                      <label for="inputText" class="col-sm-2 col-form-label">ID</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                      <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>">
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="inputTime" class="col-sm-2 col-form-label">Waktu</label>
                                      <div class="col-sm-10">
                                        <input type="time" class="form-control" name="waktu" value="<?php echo $row['waktu']; ?>">
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="inputNumber" class="col-sm-2 col-form-label">Durasi</label>
                                      <div class="col-sm-10">
                                        <input type="number" class="form-control" name="durasi" value="<?php echo $row['durasi']; ?>">
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label class="col-sm-2 col-form-label">Select</label>
                                      <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="status">
                                          <option value="<?php echo $row['status']; ?>" selected>Pilih Status</option>
                                          <option value="Selesai">Selesai</option>
                                          <option value="Belum">Belum</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" style="background-color: #4159AF;">Save changes</button>
                                    </div>
                                  </form>

                                </div>

                              </div>
                            </div>
                          </div>

                          <a type="button" class="px-2" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id']; ?>">
                            <i class="bi bi-trash" style="color: black; font-size: 20px;"></i>
                          </a>

                          <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Hapus Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Apakah yakin ingin
                                  menghapus data?
                                </div>
                                <div class="modal-footer">
                                  <form method="post" action="delete.php">
                                    <input name="id" value="<?php echo $row['id']; ?>" hidden>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" style="background-color: red;">Hapus Data</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>


                        </td>
                      </tr>
                  <?php }
                  }
                  ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>


    </section>
    <a data-bs-toggle="modal" data-bs-target="#adddata">
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
            <form action="insert_data.php" method="post">
              <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="tanggal" id="inputDate" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputTime" class="col-sm-2 col-form-label">Waktu</label>
                <div class="col-sm-10">
                  <input type="time" class="form-control" name="waktu" id="inputTime" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Durasi</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="durasi" id="inputNumber" required>
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

      document.getElementById('clock').textContent = hours + ':' + minutes + ':' + seconds + ' | ' + day + ', ' + date + ' ' + month + ' ' + year;
    }

    setInterval(updateClock, 1000); // Update setiap detik
  </script>
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