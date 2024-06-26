<?php
include('connect.php');

if(isset($_GET['id_transaksi_pengembalian'])) {
    $id_transaksi_pengembalian = $_GET['id_transaksi_pengembalian'];

    $query = "DELETE FROM transaksi_pengembalian WHERE id_transaksi_pengembalian = '$id_transaksi_pengembalian'";

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
