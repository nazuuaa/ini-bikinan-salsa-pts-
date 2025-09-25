<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";

if (isset($_POST['simpan'])) {
    $judul_buku   = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $pengarang    = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $stok         = intval($_POST['stok']);

    if ($stok < 0) $stok = 0;

    $query = "INSERT INTO stok_buku (judul_buku, pengarang, tahun_terbit, stok)
              VALUES ('$judul_buku', '$pengarang', '$tahun_terbit', $stok)";

    if (mysqli_query($koneksi, $query)) {
        header("Location: buku.php?status=success");
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>

<?php include "page/header.php"; ?> 
<?php include "page/navbar.php"; ?> 
<?php include "page/sidebar.php"; ?> 

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header"><h3 class="card-title">Form Tambah Buku</h3></div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" id="pengarang" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
              </div>
              <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
              <a href="buku.php" class="btn btn-secondary">🔙 Batal</a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<?php include "page/footer.php"; ?>
</body>
</html>