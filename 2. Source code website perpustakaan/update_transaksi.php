<?php
include('connect.php');

// Mulai sesi
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan id_transaksi_peminjaman diterima dari formulir
    if (!isset($_POST['id_transaksi_peminjaman'])) {
        echo "Error: id_transaksi_peminjaman tidak diterima dari formulir.";
        exit;
    }

    // Ambil data dari formulir
    $id_transaksi_peminjaman = $_POST['id_transaksi_peminjaman'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $qty = $_POST['qty'];

    // Ambil id_pustakawan dari session user_id
    if (!isset($_SESSION['user_id'])) {
        echo "Error: user_id tidak ditemukan dalam sesi.";
        exit;
    }
    $id_pustakawan = $_SESSION['user_id'];

    // Query untuk mendapatkan stok buku yang dipinjam
    $query_stok_buku = "SELECT stok_buku FROM buku WHERE id_buku = $id_buku";
    $result_stok_buku = $connect->query($query_stok_buku);
    if (!$result_stok_buku) {
        echo "Error: " . $connect->error;
        exit;
    }
    $row_stok_buku = $result_stok_buku->fetch_assoc();
    $stok_buku = $row_stok_buku['stok_buku'];
    // Pengecekan apakah qty yang dimasukkan melebihi stok buku atau tidak
    if ($qty > $stok_buku) {
        echo "<script>alert('Stok Tidak Mencukupi');</script>";
        echo "<script>window.location.href = 'dashboardadmin.php';</script>";
        exit;
    }

    // Pengecekan apakah qty melebihi batas maksimal peminjaman
    if ($qty > 3) {
        echo "<script>alert('Melebihi Batas Maksimal Peminjaman');</script>";
        echo "<script>window.location.href = 'dashboardadmin.php';</script>";
        exit;
    }

    // Query untuk mengupdate data transaksi
    $query_update_transaksi = "UPDATE transaksi_peminjaman SET 
        tgl_peminjaman = '$tgl_peminjaman',
        tanggal_jatuh_tempo = '$tanggal_jatuh_tempo',
        id_anggota = '$id_anggota',
        id_buku = '$id_buku',
        id_pustakawan = '$id_pustakawan',
        qty = '$qty'
        WHERE id_transaksi_peminjaman = $id_transaksi_peminjaman";

    // Jalankan query update
    if ($connect->query($query_update_transaksi) === TRUE) {
        // Kurangi stok buku yang dipinjam
        $new_stok_buku = $stok_buku - $qty;
        $query_update_stok_buku = "UPDATE buku SET stok_buku = $new_stok_buku WHERE id_buku = $id_buku";
        $connect->query($query_update_stok_buku);

        // Redirect ke halaman berhasil
        header("Location: dashboardadmin.php");
    } else {
        // Jika terjadi kesalahan saat mengupdate
        echo "Error: " . $query_update_transaksi . "<br>" . $connect->error;
    }

    // Tutup koneksi
    $connect->close();
}
?>
