<?php
require_once "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
session_start();
if(empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo '
    <center>
    <br><br><br><br><br><br><br><br><br><br>
    <b>Maaf, Silahkan Melakukan Login!</b><br><br>
    <b>Anda telah keluar dari sistem</b><br>
    <b>atau anda belum melakukan login</b><br>

    <a href="index.php" title="Klik Gambar ini untuk Kembali ke Halaman Login"><img src="img/key-login.png" height="100" width="100"></img></a>
    </center>
    ';
} else {

?>

<!doctype html>
<html lang="en">
  <head>
    <title>.:Dashboard - <?php echo ucwords(str_replace('_',' ', $_GET['hal'])) ?>:.</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 py-2 bg-primary fixed-top">
                <div class="dropdown float-right">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                        <div class="media">
                            <img class="align-self-center mr-3" src="img/logo.png" height="50" width="50" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0"><?php echo $_SESSION['namaadmin'] ?></h5>
                                <small><p class="mb-0"><i class="bi bi-clock"></i> Pkl <?php echo date('H:i:s') ?> WIB</p></small>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Setting</a>
                    <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?')"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" style="padding-top:50px">
            <div class="col-lg-2 position-fixed vh-100">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" href="dashboard.php?hal=home">Home</a>
                    <a class="nav-link" href="#">Profil</a>
                    <a class="nav-link" href="#">Galeri</a>
                    <a class="nav-link" href="#">Wisata</a>
                    <a class="nav-link" href="#">Kategori</a>
                    <a class="nav-link" href="#">Berita</a>
                </div>
            </div>
            <div class="col-lg-10 offset-2">
                
            <?php
                if (isset($_GET['hal'])) {

                    switch($_GET['hal']) {
                        case 'home':
                            include "modul/mod_home/home.php";
                            break;
                        default:
                            echo "<h3>Halaman Tidak Ditemukan</h3>";
                    }

                } else {
                    header("location:dashboard.php?hal=home");
                }
            ?>

            </div>
        </div>

      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  </body>
</html>

<?php
    }
?>