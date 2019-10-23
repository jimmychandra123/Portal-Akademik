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
  <h2>Manage Data Program Studi</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Program Studi, hanya dapat digunakan oleh admin untuk menambah dan mengedit data Program Studi di Universitas JimmyChandra.</p>
  </div>

  <div class="isikonten">
  <?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT * FROM programstudi WHERE kode_prodi = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>

  <div class="tabel">
  <a href="manage_programstudi.php">Kembali</a>
  </div>
      <h2>Form Edit Data Program Studi </h2>

          <form method="post" >
         <table class="tabel"> 
         <tbody>
          <tr width="150">
            <th>Kode Program Studi :</th>
          <td><input type="text" name="kode_prodi" value="<?php echo $row1['kode_prodi'] ?>" size="70" disabled></td>
          </tr>
          <tr>
            <th>Program Studi :</th>
          <td><input type="text" name="nama_prodi" value="<?php echo $row1['nama_prodi'] ?>" size="70"></td>
          </tr>
          </tr>
        
    
       
        <tr>
          <th colspan="2"><input type="submit" name="submit" value="Update">
          </th>
        </tr>
        </tbody>
          </table>
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
    $nama_prodi = $_POST['nama_prodi'];
    $kode_prodi = $_POST['kode_prodi'];
   if ($nama_prodi === "") {
                  echo "<script> alert('Silahkan input Nama Program Studi!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
          }if($nama_prodi) 
          {

    // $query=mysqli_query($DBConn,"UPDATE 'dosen' SET nama_dosen='$nama_dosen', prodi='$prodi', tempat_lahir='$tempat_lahir_dosen', tanggal_lahir='$tanggal_lahir_dosen', agama='$agama',status='$status' WHERE kode_dosen='$kode_dosen'");

 $sql2 = "UPDATE programstudi SET nama_prodi='$nama_prodi' WHERE kode_prodi='$id'";
  $query2 = $DBConn->query($sql2);
  
    if ($query2) {
       echo "<script> alert('Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
  }else {
       echo "<script> alert('Koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
  }
 }else {
       echo "<script> alert('Not Succesfully Editedl!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
  }
}
?>
