<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_anggota = $_POST['nama_anggota'];
    $gender_anggota = $_POST['gender_anggota'];
    $alamat_anggota = $_POST['alamat_anggota'];
    $no_telp_anggota = $_POST['no_telp_anggota'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah ada di tabel anggota
    $check_anggota = "SELECT username FROM anggota WHERE username='$username'";
    $result_anggota = $connect->query($check_anggota);

    // Cek apakah username sudah ada di tabel petugas
    $check_petugas = "SELECT username FROM petugas WHERE username='$username'";
    $result_petugas = $connect->query($check_petugas);

    if ($result_anggota->num_rows > 0 || $result_petugas->num_rows > 0) {
        echo "Username sudah ada. Gagal register.";
    } else {
        // Buat query SQL
        $sql = "INSERT INTO anggota (nama_anggota, gender_anggota, alamat_anggota, no_telp_anggota, username, password) 
                VALUES ('$nama_anggota', '$gender_anggota', '$alamat_anggota', '$no_telp_anggota', '$username', '$password')";

        if ($connect->query($sql) === TRUE) {
            header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }

    // Tutup koneksi
    $connect->close();
}
?>
