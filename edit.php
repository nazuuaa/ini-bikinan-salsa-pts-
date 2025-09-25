<?php
session_start();
include "koneksi.php";

// izinkan admin dan staff (operator kalau perlu tetap boleh)
if (!isset($_SESSION['username']) || !in_array($_SESSION['level'], ['admin','staff','operator'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("Location: staff.php");
    exit();
}

$result = $koneksi->query("SELECT * FROM stok_buku WHERE id_buku=$id");
if (!$result || $result->num_rows == 0) {
    header("Location: staff.php");
    exit();
}
$data = $result->fetch_assoc();

if (isset($_POST['simpan'])) {
    $judul_buku   = $koneksi->real_escape_string($_POST['judul_buku']);
    $pengarang    = $koneksi->real_escape_string($_POST['pengarang']);
    $tahun_terbit = $koneksi->real_escape_string($_POST['tahun_terbit']);
    $stok         = intval($_POST['stok']);
    if ($stok < 0) $stok = 0;

    $query = "UPDATE stok_buku SET 
                judul_buku='{$judul_buku}', 
                pengarang='{$pengarang}', 
                tahun_terbit='{$tahun_terbit}',
                stok={$stok}
              WHERE id_buku=$id";

    if ($koneksi->query($query)) {
        // redirect sesuai level
        if ($_SESSION['level'] == "staff") {
            header("Location: staff.php?status=success");
        } else {
            header("Location: buku.php?status=success");
        }
        exit();
    } else {
        $error = "Gagal update: " . $koneksi->error;
    }
}
?>
<!-- HTML form -->
<?php include "page/header.php"; ?>
<?php include "page/navbar.php"; ?>
<?php include "page/sidebar.php"; ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <?php if (isset($error)) { ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php } ?>
        <div class="card card-primary">
          <div class="card-header"><h3 class="card-title">Form Edit Buku</h3></div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku" class="form-control" 
                       value="<?= htmlspecialchars($data['judul_buku']) ?>" required>
              </div>
              <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" id="pengarang" class="form-control" 
                       value="<?= htmlspecialchars($data['pengarang']) ?>" required>
              </div>
              <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" 
                       value="<?= htmlspecialchars($data['tahun_terbit']) ?>" required>
              </div>
              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" 
                       value="<?= htmlspecialchars($data['stok']) ?>" required>
              </div>
              <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
              <a href="<?= ($_SESSION['level']=='staff') ? 'staff.php' : 'buku.php' ?>" class="btn btn-secondary">🔙 Batal</a>
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