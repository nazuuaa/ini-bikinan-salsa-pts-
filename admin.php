<!-- Header -->
<?php
session_start();
if ($_SESSION['level'] != "admin") {
    header("Location: ../login.php");
    exit;
}
include 'page/header.php';
?>
<!-- Akhir Header -->


<!-- Navbar -->
<?php
include 'page/navbar.php';
?>
<!--Akhir Navbar  -->

<!-- sidebar -->
<?php
include 'page/sidebar.php';
?>
<!-- Akhir Sidebar -->

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admin Panel</h3>
        </div>
        <div class="card-body">
          Selamat Datang <b>Admin</b>!
        </div>
        <div class="card-footer">
          Footer
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<!-- ./wrapper -->

<?php
include 'page/footer.php';
?>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>