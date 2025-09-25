<?php
// Pastikan session sudah start di file utama
if (!isset($_SESSION['level'])) {
    header("Location: index.php");
    exit;
}

$level = $_SESSION['level'];
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">MultiUser App</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $_SESSION['username']; ?> (<?= $level ?>)</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<!-- Admin Menu -->
<?php if($level == 'admin'): ?>
  <li class="nav-item">
    <a href="index.php" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>Dashboard Admin</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="buku.php" class="nav-link">
      <i class="nav-icon fas fa-book-open"></i>
    <p>Data Buku</p>
   </a>
  </li>
<?php endif; ?>

<!-- staff Menu -->
<?php if($level == 'staff'): ?>
  <li class="nav-item">
    <a href="index.php" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>Dashboard staff</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="buku.php" class="nav-link">
      <i class="nav-icon fas fa-book-open"></i>
      <p>Data Buku</p>
    </a>
  </li>
<?php endif; ?>

<!-- User Menu -->
<?php if($level == 'user'): ?>
  <li class="nav-item">
    <a href="index.php" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>Dashboard User</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="buku.php" class="nav-link">
      <i class="nav-icon fas fa-book-open"></i>
      <p>Data Buku</p>
    </a>
  </li>
<?php endif; ?>


        <!-- Logout -->
        <li class="nav-item mt-3">
          <a href="logout.php" class="nav-link btn btn-danger text-white">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
