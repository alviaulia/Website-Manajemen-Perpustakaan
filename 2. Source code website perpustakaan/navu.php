<?php
// Mulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pengecekan session
if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); // Pastikan untuk menghentikan eksekusi script setelah pengalihan
}

include('connect.php');

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Query SQL untuk mengambil data anggota berdasarkan user_id
$query_select_anggota = "SELECT * FROM anggota WHERE id_anggota = ?";
$stmt = $connect->prepare($query_select_anggota);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_anggota = $stmt->get_result();

// Periksa apakah data anggota ditemukan
if ($result_anggota->num_rows > 0) {
    // Data anggota ditemukan, Anda bisa menggunakan data tersebut sesuai kebutuhan

    // Ambil data anggota
    $anggota = $result_anggota->fetch_assoc();

    // Gunakan data anggota sesuai kebutuhan
    $nama_anggota = $anggota['nama_anggota'];
    $gender = $anggota['gender_anggota'];
    $username = $anggota['username'];
    $password = $anggota['password'];
    $alamat = $anggota['alamat_anggota'];
    $no_telp = $anggota['no_telp_anggota'];
    $id_anggota = $anggota['id_anggota'];
} else {
    // Jika data anggota tidak ditemukan
    echo "Data anggota tidak ditemukan.";
}

// Tutup statement SELECT dan koneksi database
$stmt->close();
?>

<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #ffffff00; color: white;">
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <h6 style="background-color: white;">
                        <?php echo htmlspecialchars($nama_anggota); ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;"></span>
                </a><!-- End Profile Image Icon -->
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
                <form action="update_anggota.php" method="POST" class="row g-3 needs-validation" novalidate>
                    <input type="hidden" name="id_anggota" value="<?php echo htmlspecialchars($id_anggota); ?>">
                    <div class="col-12">
                        <label for="namaAnggota" class="form-label">Nama Anggota</label>
                        <input type="text" name="nama_anggota" class="form-control" id="namaAnggota" value="<?php echo htmlspecialchars($nama_anggota); ?>" required>
                        <div class="invalid-feedback">Please enter the member's name!</div>
                    </div>
                    <div class="col-12">
                        <label for="genderAnggota" class="form-label">Jenis Kelamin</label>
                        <select name="gender_anggota" class="form-select" id="genderAnggota" required>
                            <option value="<?php echo htmlspecialchars($gender); ?>" disabled ><?php echo htmlspecialchars($gender); ?></option>
                            <option value="Laki Laki">Laki Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">Please select the gender!</div>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <div class="invalid-feedback">Please enter the username!</div>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?php echo htmlspecialchars($password); ?>" required>
                        <div class="invalid-feedback">Please enter the password!</div>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat_anggota" class="form-control" id="alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
                        <div class="invalid-feedback">Please enter the address!</div>
                    </div>
                    <div class="col-12">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" name="no_telp_anggota" class="form-control" id="no_telp" value="<?php echo htmlspecialchars($no_telp); ?>" required>
                        <div class="invalid-feedback">Please enter the phone number!</div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
