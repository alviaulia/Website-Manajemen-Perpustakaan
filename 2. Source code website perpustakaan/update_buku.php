<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui formulir
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $stok_buku = $_POST['stok_buku'];

    // Query SQL untuk melakukan update data buku
    $query = "UPDATE buku SET judul_buku='$judul_buku', penulis='$penulis', stok_buku='$stok_buku' WHERE id_buku='$id_buku'";

    // Menjalankan query dan memeriksa apakah berhasil
    if ($connect->query($query) === TRUE) {
        header("Location: buku.php");
    } else {
        echo "Error: " . $query . "<br>" . $connect->error;
    }

    // Menutup koneksi database
    $connect->close();
}
?>
