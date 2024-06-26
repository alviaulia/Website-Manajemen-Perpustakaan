<?php
session_start(); // Mulai session

include 'connect.php';

// Mendapatkan tanggal dikembalikan dan tanggal jatuh tempo dari $_POST
$tgl_dikembalikan = $_POST['tgl_dikembalikan'];
$tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
$qty = $_POST['qty'];
$id_buku = $_POST['id_buku'];

// Memasukkan data ke dalam tabel transaksi_pengembalian
$id_transaksi_peminjaman = $_POST['id_transaksi_peminjaman'];
$id_pustakawan = $_SESSION['user_id']; // Mendapatkan id_pustakawan dari session user_id

$query_pengembalian = "INSERT INTO transaksi_pengembalian (id_transaksi_peminjaman, tgl_dikembalikan, id_pustakawan) 
                       VALUES ('$id_transaksi_peminjaman', '$tgl_dikembalikan', '$id_pustakawan')";

$result_pengembalian = $connect->query($query_pengembalian);

if ($result_pengembalian) {
    // Mendapatkan ID dari transaksi pengembalian yang baru dimasukkan
    $id_transaksi_pengembalian = $connect->insert_id;

    // Menghitung selisih hari antara tanggal jatuh tempo dan tanggal dikembalikan
    $selisih_hari = strtotime($tgl_dikembalikan) - strtotime($tanggal_jatuh_tempo);
    $selisih_hari = floor($selisih_hari / (60 * 60 * 24));

    // Jika terjadi keterlambatan pengembalian, tambahkan data ke dalam tabel denda
    if ($selisih_hari > 0) {
        $tarif_denda = $_POST['tarif_denda'];
        $total_denda = $tarif_denda * $selisih_hari;
        $status_pembayaran = 'Belum';

        // Memasukkan data ke dalam tabel denda
        $query_denda = "INSERT INTO denda (id_transaksi_pengembalian, lama_keterlambatan, tarif_denda, total_denda, status_pembayaran) 
                        VALUES ('$id_transaksi_pengembalian', '$selisih_hari', '$tarif_denda', '$total_denda', '$status_pembayaran')";

        $result_denda = $connect->query($query_denda);

        if ($result_denda) {
            // Data berhasil dimasukkan ke dalam tabel denda

            // Perbarui jumlah persediaan buku
            $query_update_qty = "UPDATE buku SET stok_buku = stok_buku + $qty WHERE id_buku = $id_buku";
            $result_update_qty = $connect->query($query_update_qty);

            if ($result_update_qty) {
                // Jumlah persediaan buku berhasil diperbarui
                // Redirect ke halaman dashboardadmin.php
                header("Location: dashboardadmin.php");
                exit();
            } else {
                // Jika terjadi kesalahan saat memperbarui jumlah persediaan buku
                echo "Terjadi kesalahan saat memperbarui jumlah persediaan buku: " . $connect->error;
            }
        } else {
            // Jika terjadi kesalahan saat memasukkan data ke dalam tabel denda
            echo "Terjadi kesalahan saat memasukkan data ke dalam tabel denda: " . $connect->error;
        }
    } else {
        // Jika tidak terjadi keterlambatan pengembalian, tidak perlu memasukkan data ke dalam tabel denda

        // Perbarui jumlah persediaan buku
        $query_update_qty = "UPDATE buku SET stok_buku = stok_buku + $qty WHERE id_buku = $id_buku";
        $result_update_qty = $connect->query($query_update_qty);

        if ($result_update_qty) {
            // Jumlah persediaan buku berhasil diperbarui
            // Redirect ke halaman dashboardadmin.php
            header("Location: dashboardadmin.php");
            exit();
        } else {
            // Jika terjadi kesalahan saat memperbarui jumlah persediaan buku
            echo "Terjadi kesalahan saat memperbarui jumlah persediaan buku: " . $connect->error;
        }
    }
} else {
    // Jika terjadi kesalahan saat memasukkan data ke dalam tabel transaksi_pengembalian
    echo "Terjadi kesalahan saat memasukkan data ke dalam tabel transaksi_pengembalian: " . $connect->error;
}

// Menutup koneksi database
$connect->close();
?>
