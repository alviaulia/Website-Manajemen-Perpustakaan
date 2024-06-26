<?php
session_start(); // Mulai session

// Pengecekan session
if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); // Pastikan untuk menghentikan eksekusi script setelah pengalihan
}

include('connect.php');

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Query SQL untuk mengambil data petugas berdasarkan user_id
$query_select_petugas = "SELECT * FROM petugas WHERE id_pustakawan = ?";
$stmt = $connect->prepare($query_select_petugas);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_petugas = $stmt->get_result();

// Periksa apakah data petugas ditemukan
if ($result_petugas->num_rows > 0) {
    // Data petugas ditemukan, Anda bisa menggunakan data tersebut sesuai kebutuhan

    // Ambil data petugas
    $petugas = $result_petugas->fetch_assoc();

    // Gunakan data petugas sesuai kebutuhan
    $nama_petugas = $petugas['nama_pustakawan'];
    $gender = $petugas['gender_pustakawan'];
    $username = $petugas['username'];
    $password = $petugas['password'];
    $id_pustakawan = $petugas['id_pustakawan'];
} else {
    // Jika data petugas tidak ditemukan
    echo "Data petugas tidak ditemukan.";
}

// Tutup statement SELECT dan koneksi database
$stmt->close();

?>

<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #ffffff00; color: white;; ">





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
                    <h6 style="background-color: white;">
                        <?php echo $nama_petugas ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered">
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
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>

        </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->


<div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Formulir -->
                <form action="update_petugas.php" method="POST" class="row g-3 needs-validation" novalidate>
    <input type="hidden" name="id_pustakawan" value="<?php echo $id_pustakawan ?>">
    <div class="col-12">
        <label for="namaPustakawan" class="form-label">Nama Pustakawan</label>
        <input type="text" name="nama_pustakawan" class="form-control" id="namaPustakawan" value="<?php echo $nama_petugas ?>">
        <div class="invalid-feedback">Please enter the librarian's name!</div>
    </div>

    <div class="col-12">
        <label for="genderPustakawan" class="form-label">Jenis Kelamin</label>
        <select name="gender_pustakawan" class="form-select" id="genderPustakawan" required>
            <option value="<?php echo $gender ?>" disabled><?php echo $gender ?></option>
            <option value="Laki Laki">Laki Laki</option>
            <option value="Perempuan">Permenpuan</option>
        </select>
        <div class="invalid-feedback">Please select the gender!</div>
    </div>

    <div class="col-12">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?php echo $username ?>">
        <div class="invalid-feedback">Please enter the username!</div>
    </div>

    <div class="col-12">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo $password ?>">
        <div class="invalid-feedback">Please enter the password!</div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Simpan</button>
    </div>
</form>





            </div>

        </div>
    </div>
</div>