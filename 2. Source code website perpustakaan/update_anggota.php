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

// Ambil data dari formulir
$id_anggota = $_POST['id_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$gender_anggota = $_POST['gender_anggota'];
$username = $_POST['username'];
$password = $_POST['password'];
$alamat_anggota = $_POST['alamat_anggota'];
$no_telp_anggota = $_POST['no_telp_anggota'];

// Query SQL untuk mengupdate data anggota
$query_update_anggota = "UPDATE anggota SET nama_anggota = ?, gender_anggota = ?, username = ?, password = ?, alamat_anggota = ?, no_telp_anggota = ? WHERE id_anggota = ?";
$stmt = $connect->prepare($query_update_anggota);
$stmt->bind_param("ssssssi", $nama_anggota, $gender_anggota, $username, $password, $alamat_anggota, $no_telp_anggota, $id_anggota);

// Eksekusi query
if ($stmt->execute()) {
    // Jika update berhasil, arahkan kembali ke halaman profil atau halaman lain yang sesuai
    header("Location: dashboarduser.php");
} else {
    // Jika update gagal, tampilkan pesan error
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi database
$stmt->close();
$connect->close();
?>
