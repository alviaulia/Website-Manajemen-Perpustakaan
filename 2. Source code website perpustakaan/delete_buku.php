<?php
include('connect.php');

if(isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    $query = "DELETE FROM buku WHERE id_buku = '$id_buku'";

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
