<?php
session_start();

// cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ambil level dari session
$level = $_SESSION['level'];

include "page/header.php";
include "page/navbar.php";
include "page/sidebar.php";
?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>
          <?php if ($level === 'operator') { ?>
            Dashboard Operator
          <?php } elseif ($level === 'admin') { ?>
            Dashboard Admin
          <?php } ?>
        </h1>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
          Selamat datang, <b><?= $_SESSION['username']; ?></b>!  
          <?php if ($level === 'operator') { ?>
            Ini adalah dashboard khusus Operator.
          <?php } elseif ($level === 'admin') { ?>
            Ini adalah dashboard khusus Admin.
          <?php } ?>
        </div>
      </div>
    </section>
  </div>
</div>

<?php include "page/footer.php"; ?>
</body>
</html>
