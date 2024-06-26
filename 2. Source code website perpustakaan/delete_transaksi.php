<?php
include('connect.php');

if(isset($_GET['id_transaksi_peminjaman'])) {
    $id_transaksi_peminjaman = $_GET['id_transaksi_peminjaman'];

    $query = "DELETE FROM transaksi_peminjaman WHERE id_transaksi_peminjaman = '$id_transaksi_peminjaman'";

    if ($connect->query($query) === TRUE) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus buku: " . $connect->error;
    }
} else {
    echo "ID buku tidak ditemukan.";
}
?>
