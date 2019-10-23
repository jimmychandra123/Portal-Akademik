<?php
  session_start();
include 'koneksi.php';
  if(!isset($_SESSION["AdminID"]))
  {
    header("Location: index.php");
  };

  $sql = "SELECT * FROM admin WHERE kode_admin = '" . $_SESSION['AdminID'] . "'";
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
    <h1><?php echo $row['nama_admin']; ?></h1>
    <h1><?php echo $row['kode_admin']; ?></h1>
    <h1><?php echo $row['no_hp']; ?></h1>
    <a href="index.php">Logout</a>
  </div>
<br><h2>Manage Akademik</h2>
<nav >
 <a href="halaman_admin.php">Halaman Depan</a> 
 <a href="manage_dosen.php">Dosen</a> 
 <a href="manage_mahasiswa.php">Mahasiswa</a> 
 <a href="manage_semester.php">Semester</a>
 <a href="manage_programstudi.php">Program Studi</a> 
 <a href="manage_kelas.php">Kelas</a>
 <a href="manage_ruangkelas.php">Ruang Kelas</a>
 <a href="manage_matakuliah.php">Mata Kuliah</a>
 <a href="manage_jadwal.php">Jadwal Kelas</a><br>
 <br><h2>Manage Information</h2>
 <a href="manage_pengumuman.php">Pengumuman</a> 
 <a href="ubah_passwordadmin.php">Change Password</a>
</nav>
</div>

<div class="konten">
  <h2>Manage Data Mahasiswa</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Mahasiswa, hanya dapat digunakan oleh admin untuk menambah dan mengedit data Mahasiswa di Universitas JimmyChandra.</p>
  </div>

  <div class="isikonten">
  <?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT mahasiswa.*, programstudi.nama_prodi, semester.semester FROM mahasiswa INNER JOIN programstudi ON mahasiswa.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON mahasiswa.kode_semester = semester.kode_semester WHERE npm = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>

  <div class="tabel">
  <a href="manage_mahasiswa.php">Kembali</a>
  </div>
      <h2>Form View Data Mahasiswa </h2>

          <form method="post" >
            <table class="tabel" >
   <tbody><tr width="150"> 
      <th>NPM</th>
            <td><?php echo $row1['npm']; ?></td>
   </tr> 
         <tr> 
            <th>Nama</th>
            <td><?php echo $row1['nama']; ?></td>
         </tr>
         <tr> 
            <th>Program Studi</th>
            <td><?php echo $row1['nama_prodi']; ?></td>
         </tr>
         <tr> 
            <th>Tempat Tanggal Lahir</th>
            <td><?php echo $row1['tempat_lahir']; ?>,&nbsp;<?php echo $row1['tanggal_lahir']; ?></td>
         </tr>

         <tr> 
            <th>Agama</th>
            <td><?php echo $row1['agama']; ?></td>
         </tr>
         <tr> 
            <th>Jenis Kelamin</th>
            <td><?php echo $row1['gender']; ?></td>
         </tr>   
          <tr> 
            <th>Alamat</th>
            <td><?php echo $row1['alamat']; ?></td>
         </tr>
          <tr> 
            <th>No HP</th>
            <td><?php echo $row1['no_hp']; ?></td>
         </tr>

         <tr> 
            <th>Status</th>
            <td><?php echo $row1['status_aktif']; ?></td>
         </tr>   
   </tbody></table>
          </form>
    </div>
  </div>






<div class="footer">
  <h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>  
© 2019 - 2030. All Right Reserved</h2>
</div>


</div>





</body>
</html>



