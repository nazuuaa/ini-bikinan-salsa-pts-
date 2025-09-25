<?php
session_start();
include "koneksi.php";

// inisialisasi percobaan login gagal
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lock_time'] = 0;
}

$locked = false;
$sisa = 0;

// cek apakah akun terkunci
if ($_SESSION['login_attempts'] == 3) {
    $waktu_sekarang = time();
    $selisih = $waktu_sekarang - $_SESSION['lock_time'];

    if ($selisih < 50) {
        $locked = true;
        $sisa = 50 - $selisih;
    } else {
        // reset setelah 50 detik
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lock_time'] = 0;
    }
}

if (isset($_POST['login']) && !$locked) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND level='$level'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['level']    = $row['level'];

        // reset percobaan login
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lock_time'] = 0;

        if ($row['level'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row['level'] == 'staff') {
            header("Location: staff.php");
        } elseif ($row['level'] == 'user') {
            header("Location: user.php");
        }
        exit();
    } else {
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['lock_time'] = time();
        } else {
            echo "<script>alert('Login gagal! Username, Password, atau Level salah!'); window.location='login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Multi User</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      width: 360px;
      box-shadow: 0px 10px 30px rgba(0,0,0,0.25);
      text-align: center;
      animation: fadeIn 1s ease;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    input, select, button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
    }
    input:focus, select:focus {
      border-color: #667eea;
      box-shadow: 0 0 5px rgba(102,126,234,0.5);
    }
    button {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #fff;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0px 5px 15px rgba(102,126,234,0.4);
    }
    .locked {
      color: #e74c3c;
      font-weight: bold;
      margin-top: 15px;
      font-size: 14px;
      background: #fdecea;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #f5c6cb;
      animation: pulse 1s infinite;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(231,76,60,0.4); }
      70% { box-shadow: 0 0 0 10px rgba(231,76,60,0); }
      100% { box-shadow: 0 0 0 0 rgba(231,76,60,0); }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>🔐 Login Multi User</h2>

    <?php if ($locked): ?>
      <p class="locked">⚠️ Akun terkunci! Silakan tunggu <span id="countdown"><?= $sisa ?></span> detik lagi ⏳</p>
      <script>
        let timeLeft = <?= $sisa ?>;
        let countdownEl = document.getElementById("countdown");
        let timer = setInterval(() => {
          timeLeft--;
          countdownEl.textContent = timeLeft;
          if (timeLeft <= 0) {
            clearInterval(timer);
            location.reload(); // refresh halaman setelah waktu habis
          }
        }, 1000);
      </script>
    <?php else: ?>
      <form action="" method="post">
        <input type="text" name="username" placeholder="👤 Username" required>
        <input type="password" name="password" placeholder="🔑 Password" required>
        <select name="level" required>
          <option value="">-- Pilih Level --</option>
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
          <option value="user">User</option>
        </select>
        <button type="submit" name="login">Masuk</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>