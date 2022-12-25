<?php
include "koneksi.php";

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($query);

$r = mysqli_fetch_array($query);

if ($cek > 0) {

    $_SESSION['namaadmin']  = $r['nama_admin'];
    $_SESSION['username']   = $r['username'];
    $_SESSION['password']   = $r['password'];
    $_SESSION['idadmin']    = $r['id_admin'];

    if (!empty($_POST["remember"])) {
        setcookie("username", $_POST["username"], time() + (60 * 60 * 24 * 5));
        setcookie("password", $_POST["password"], time() + (60 * 60 * 24 * 5));
    } else {
        setcookie("username", "");
        setcookie("password", "");
    }

    header("location:dashboard.php?hal=home");
} else {
    echo'
    <center>
    <br><br><br><br><br><br><br><br><br><br>
    <b>Username atau Password Salah!</b><br><br>
    <b>atau</b><br>
    <b>Akun anda telah diblokir</b><br>

    <a href="index.php" title="Klik Gambar ini untuk Kembali ke Halaman Login"><img src="img/key-login.png" height="100" width="100"></img></a>
    </center>
    ';
}

?>