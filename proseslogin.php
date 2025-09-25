<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // simpan session
        $_SESSION['username'] = $data['username'];
        $_SESSION['level']    = $data['level'];

        // arahkan sesuai role
        if ($data['level'] == "admin") {
            header("Location: admin.php");
        } elseif ($data['level'] == "staff") {
            header("Location: staff.php");
        } elseif ($data['level'] == "user") {
            header("Location: user.php");
        } else {
            echo "Level tidak dikenali!";
        }
    } else {
        echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
    }
}
?>
