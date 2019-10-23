<?php
  session_start();
include 'koneksi.php';
  if(!isset($_SESSION["MahasiswaID"]))
  {
    header("Location: index.php");
  };

  $sql = "SELECT mahasiswa.*, programstudi.*, semester.semester FROM mahasiswa INNER JOIN programstudi ON mahasiswa.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON mahasiswa.kode_semester = semester.kode_semester WHERE npm = '" . $_SESSION['MahasiswaID'] . "'";
  $result = $DBConn->query($sql);
  $row = $result->fetch_assoc();
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Portal Akademik UNIVERSITAS JIMMY CHANDRA</title>

  <link rel="stylesheet" type="text/css" href="css/tampilanmenuutama.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">



</head>
<body >

<div class="wrapper">

<div class="header">
<img src="logojc.png" width="1000px" height="150px">
</div>

<div class="menu">
  <div class="profil" >
    <p>Informasi Pengguna</p>
    <br>
    <img src="logoprofil.png" width="100px" height="100px">
    <br>
    <h1><?php echo $row['nama']; ?></h1>
    <h1><?php echo $row['npm']; ?></h1>
    <h1><?php echo $row['nama_prodi']; ?></h1>
    <a href="index.php">Logout</a>
  </div>
<?php
include'menu-mahasiswa.php';
?>
</div>

<div class="konten">
  <h2>Detail Pengumuman Akademik</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
     Detail Pengumuman Akademik, Fitur ini hanya dapat digunakan untuk melihat informasi terbaru di Universitas JimmyChandra.</p></div>
    
  
  <?php
  if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT * FROM pengumuman WHERE kode_pengumuman = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>
  
  <div class="isikonten">
  <h2>Detail <?php echo $row1['kategori'];?></h2>
  <table class="tabel">
            <tbody><tr> 
               <td align="left"><strong><b><?php echo $row1['judul_pengumuman'];?><b></b></b></strong></td>
            </tr>
            <tr> 
               <td align="left"><?php echo $row1['tanggal_kirim'];?>, <?php echo $row1['jam'];?></td>
            </tr>
            <tr> 
               <td align="left"><p>   
             <?php echo $row1['isi_pengumuman'];?>
             </p></td>
            </tr>
            <tr>
               <td><a href="halaman_mahasiswa.php">Kembali</a></td>
            </tr>
         </tbody></table>
   
</div>
</div>





<div class="footer">
  <h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>  
© 2019 - 2030. All Right Reserved</h2>
</div>


</div>





</body>
</html>
