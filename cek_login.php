<?php
include "koneksi.php";

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$time=time()-30;
$ip_address=getIpAddr();
$query=mysqli_prepare($koneksi,"SELECT COUNT(*) as total_count from login_logs where try_times > ? and ip_address=?");
mysqli_stmt_bind_param($query,"ss",$time,$ip_address);
mysqli_stmt_execute($query);
$result=mysqli_stmt_get_result($query);
$check_login_row=mysqli_fetch_assoc($result);
$total_count=$check_login_row['total_count'];
if($total_count==3){
    echo "<script>alert('Terlalu banyak percobaan, coba lagi dalam 30 detik!'); window.location = 'index.php'</script>";
}else{
    $query = mysqli_prepare($koneksi, "SELECT * FROM tbl_admin WHERE username=?");
    mysqli_stmt_bind_param($query,"s",$username);
    mysqli_stmt_execute($query);
    $result=mysqli_stmt_get_result($query);
    $cek = mysqli_num_rows($result);    
    $r = mysqli_fetch_array($result);

    if ($cek > 0) {

        if(password_verify($password, $r['password'])){
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
            mysqli_query($koneksi,"DELETE from login_logs WHERE ip_address='$ip_address'");
            header("location:dashboard.php?hal=home");
        }
        else{
            $total_count++;
            $rem_attm=3-$total_count;
            if($rem_attm==0){
                echo "<script>alert('Terlalu banyak percobaan, coba lagi dalam 30 detik!'); window.location = 'index.php'</script>";
            }else{
                echo "<script>alert('Password atau username salah! Sisa $rem_attm percobaan lagi!');window.location = 'index.php'</script>";
            }
            $try_time=time();
            mysqli_query($koneksi,"INSERT into login_logs values('','$ip_address','$try_time')");
        }

    } else {
        $total_count++;
        $rem_attm=3-$total_count;
        if($rem_attm==0){
            echo "<script>alert('Terlalu banyak percobaan, coba lagi dalam 30 detik!'); window.location = 'index.php'</script>";
        }else{
            echo "<script>alert('Password atau username salah! Sisa $rem_attm percobaan lagi!');window.location = 'index.php'</script>";
        }
        $try_time=time();
        mysqli_query($koneksi,"INSERT into login_logs values('','$ip_address','$try_time')");
    }
}
function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
    $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}
?>