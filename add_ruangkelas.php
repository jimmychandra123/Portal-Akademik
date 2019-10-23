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
  <h2>Manage Data Ruang Kelas</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Ruang Kelas, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Ruang Kelas di Universitas JimmyChandra.</p>
  </div>
  <div class="isikonten">
  <div class="tabel">
  <a href="manage_ruangkelas.php">Kembali</a>
  </div>
      <h2>Form Tambah Data Ruang Kelas</h2>

          <form method="post" >
         <table class="tabel"> 
         <tbody>
          <tr width="150">
            <th>Kode Ruang Kelas :</th>
          <td><input type="text" name="kode_ruang" size="70"></td>
          </tr>
         
         <tr>
         <th>Nama Ruang Kelas :</th>
          <td><input type="text" name="nama_ruang" size="70"></td>
          </tr>
    
    <tr>
        <th>Kategori Ruang Kelas :</th>
            <td><select style="width:450px" name="kategori">
              <option value="" selected="">~~~ Silahkan Pilih Kategori ~~~</option>
              <option value="Kelas">Kelas</option>
              <option value="Lab">Lab</option>
          </select></td>
          </tr>
        </tr>
       
       
        </tr>
        </tbody>
          </table>
          <div class="isikonten">
    <center><input type="submit" name="submit" value="Submit"></center>
</div>
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


<?php 
  include"koneksi.php";

  if (isset($_POST['submit'])) {
    $kode_ruang = $_POST['kode_ruang'];
    $nama_ruang = $_POST['nama_ruang'];
    $kategori = $_POST['kategori']; 

          
         if($kode_ruang === "") {
                  echo "<script> alert('Silahkan input Kode Ruangan!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_ruangkelas.php">';
          }if($nama_ruang === "") {
                  echo "<script> alert('Silahkan input Nama Ruangan!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_ruangkelas.php">';
          }if($kategori === "") {
                  echo "<script> alert('Silahkan input Kategori!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_ruangkelas.php">';
          }if($kode_ruang && $nama_ruang && $kategori) 
          {
            
                $query = mysqli_query($DBConn,"INSERT INTO ruangkelas(kode_ruang, nama_ruang, kategori) VALUES ('$kode_ruang','$nama_ruang','$kategori')");

                if($query){
                 echo "<script> alert('Succesfully Added!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_ruangkelas.php">';
              }else{
      echo "<script> alert('koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_ruangkelas.php">';
  }
}else{
      echo "<script> alert('Not Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_ruangkelas.php">';
  }
}
?>
