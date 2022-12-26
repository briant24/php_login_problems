<?php
include "koneksi.php";

session_start();

$id = '';
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$fix_pass = password_hash($password,PASSWORD_DEFAULT);

$query = mysqli_prepare($koneksi, "INSERT INTO tbl_admin VALUES(?,?,?,?)");
mysqli_stmt_bind_param($query,"ssss",$id,$nama,$username,$fix_pass);
mysqli_stmt_execute($query);
if ($query) {
    echo "<script>alert('Berhasil Daftar, Silahkan Login!'); window.location = 'index.php'</script>";
} else {
    echo'
    <center>
    <br><br><br><br><br><br><br><br><br><br>
    <b>GAGAL MENDAFTAR!</b><br><br>
    <b>atau</b><br>
    <b>Akun anda telah diblokir</b><br>
    <a href="daftar.php" title="Klik Gambar ini untuk Kembali ke Halaman Dafar"><img src="img/key-login.png" height="100" width="100"></img></a>
    </center>
    ';
}

?>