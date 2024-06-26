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

// Ambil data yang dikirimkan melalui metode POST
$id_pustakawan = $_POST['id_pustakawan'];
$nama_pustakawan = $_POST['nama_pustakawan'];
$gender_pustakawan = $_POST['gender_pustakawan'];
$username = $_POST['username'];
$password = $_POST['password'];

// Query SQL untuk memperbarui data petugas
$query_update_petugas = "UPDATE petugas SET nama_pustakawan = ?, gender_pustakawan = ?, username = ?, password = ? WHERE id_pustakawan = ?";
$stmt_update = $connect->prepare($query_update_petugas);
$stmt_update->bind_param("ssssi", $nama_pustakawan, $gender_pustakawan, $username, $password, $id_pustakawan);

// Jalankan query UPDATE
if ($stmt_update->execute()) {

      header("Location: dashboardadmin.php");
} else {
    echo "Gagal memperbarui data petugas: " . $stmt_update->error;
}

// Tutup statement UPDATE dan koneksi database
$stmt_update->close();
$connect->close();
?>
