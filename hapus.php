<?php
include 'koneksi.php';

// pastikan id valid
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $query = "DELETE FROM stok_buku WHERE id_buku = $id";
    mysqli_query($koneksi, $query);
}

// setelah hapus, kembali ke halaman buku
header("Location: buku.php");
exit();
?>
