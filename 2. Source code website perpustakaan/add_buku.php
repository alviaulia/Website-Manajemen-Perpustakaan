<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $stok_buku = $_POST['stok_buku'];

    $query = "INSERT INTO buku (judul_buku, penulis, stok_buku) VALUES ('$judul_buku', '$penulis', '$stok_buku')";

    if ($connect->query($query) === TRUE) {
        header("Location: buku.php");
    } else {
        echo "Error: " . $query . "<br>" . $connect->error;
    }

    $connect->close();
}
?>
