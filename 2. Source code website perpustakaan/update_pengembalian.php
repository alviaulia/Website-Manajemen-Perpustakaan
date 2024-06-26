<?php
session_start(); // Mulai session

include 'connect.php';

// Mendapatkan data dari formulir
$id_transaksi_peminjaman = $_POST['id_transaksi_pengembalian'];
$tgl_kembali = $_POST['tgl_kembali'];
$tarif_denda = $_POST['tarif_denda'];
$total_denda = $_POST['total_denda'];
$lama_keterlambatan = $_POST['lama_keterlambatan'];
$status_pembayaran = $_POST['status_pembayaran'];

// Query untuk memperbarui data pengembalian
$query_update_pengembalian = "UPDATE transaksi_pengembalian SET tgl_dikembalikan = '$tgl_kembali' WHERE id_transaksi_peminjaman = $id_transaksi_peminjaman";
$result_update_pengembalian = $connect->query($query_update_pengembalian);

if ($result_update_pengembalian) {
    // Query untuk memperbarui data denda
    $query_update_denda = "UPDATE denda SET tarif_denda = '$tarif_denda', total_denda = '$total_denda', lama_keterlambatan = '$lama_keterlambatan', status_pembayaran = '$status_pembayaran' WHERE id_transaksi_pengembalian = $id_transaksi_peminjaman";
    $result_update_denda = $connect->query($query_update_denda);
    // echo ($query_update_denda);
    // die();

    if ($result_update_denda) {
        // Jika kedua update berhasil, arahkan kembali ke halaman dashboardadmin.php
        header("Location: pengembalian.php");
        exit();
    } else {
        // Jika terjadi kesalahan saat memperbarui data denda
        echo "Terjadi kesalahan saat memperbarui data denda: " . $connect->error;
    }
} else {
    // Jika terjadi kesalahan saat memperbarui data pengembalian
    echo "Terjadi kesalahan saat memperbarui data pengembalian: " . $connect->error;
}

// Menutup koneksi database
$connect->close();
?>
