<?php
session_start(); // Mulai session

include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui formulir
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $qty = $_POST['qty'];

    // Cek jika qty lebih dari tiga
    if ($qty > 3) {
        // Tampilkan pesan error jika melebihi batas maksimal peminjaman
        echo "<script>alert('Melebihi Batas Maksimal Peminjaman!'); window.location='dashboardadmin.php';</script>";
        exit(); // Keluar dari skrip setelah menampilkan pesan pop-up
    }

    // Ambil id_pustakawan dari session user_id
    $id_pustakawan = $_SESSION['user_id'];

    // Query SQL untuk mendapatkan stok buku
    $query_stok = "SELECT stok_buku FROM buku WHERE id_buku = '$id_buku'";
    $result_stok = $connect->query($query_stok);
    $row_stok = $result_stok->fetch_assoc();
    $stok_buku = $row_stok['stok_buku'];

    // Cek apakah stok mencukupi
    if ($qty > $stok_buku) {
        // Tampilkan pesan error jika stok tidak mencukupi
        echo "<script>alert('Stok Tidak Mencukupi!'); window.location='dashboardadmin.php';</script>";
        exit(); // Keluar dari skrip setelah menampilkan pesan pop-up
    }

    // Buat query SQL untuk menambahkan data transaksi
    $sql = "INSERT INTO transaksi_peminjaman (tgl_peminjaman, tanggal_jatuh_tempo, id_anggota, id_buku, id_pustakawan, qty) 
            VALUES ('$tgl_peminjaman', '$tanggal_jatuh_tempo', '$id_anggota', '$id_buku', '$id_pustakawan', '$qty')";

    // Jalankan query dan periksa keberhasilannya
    if ($connect->query($sql) === TRUE) {
        // Update stok buku
        $new_stok = $stok_buku - $qty;
        $update_stok_query = "UPDATE buku SET stok_buku = '$new_stok' WHERE id_buku = '$id_buku'";
        if ($connect->query($update_stok_query) === TRUE) {
            // Jika berhasil, redirect ke halaman lain atau tampilkan pesan sukses
            header("Location: dashboardadmin.php");
            exit(); // Pastikan untuk keluar dari skrip setelah redirect
        } else {
            // Jika terjadi kesalahan saat mengupdate stok, tampilkan pesan error
            echo "Error updating stock: " . $connect->error;
        }
    } else {
        // Jika terjadi kesalahan saat menambahkan transaksi, tampilkan pesan error
        echo "Error adding transaction: " . $connect->error;
    }

    // Tutup koneksi
    $connect->close();
}
?>
