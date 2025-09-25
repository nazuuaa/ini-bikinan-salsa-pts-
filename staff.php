<?php
session_start();
// hanya staff yang bisa akses halaman ini
if ($_SESSION['level'] != "staff") {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
include 'page/header.php';
include 'page/navbar.php';
include 'page/sidebar.php';
?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Staff</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Stok Buku</h3>
        </div>

        <div class="card-body">
          <!-- Tabel Data Buku -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th> <!-- hanya edit -->
              </tr>
            </thead>
            <tbody>
              <?php
                $sqlt = mysqli_query($koneksi, "SELECT * FROM stok_buku");
                $no = 1;
                while($dat = mysqli_fetch_assoc($sqlt)) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($dat['judul_buku']); ?></td>
                <td><?= htmlspecialchars($dat['pengarang']); ?></td>
                <td><?= htmlspecialchars($dat['tahun_terbit']); ?></td>
                <td><?= htmlspecialchars($dat['stok']); ?></td>
                <td>
                  <!-- Staff hanya bisa edit -->
                  <a href="edit.php?id=<?= $dat['id_buku'] ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <div class="card-footer">
          footer
        </div>
      </div>
    </section>
  </div>
</div>

<?php include "page/footer.php"; ?>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>