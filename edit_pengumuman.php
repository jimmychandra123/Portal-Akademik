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
  <h2>Manage Data Pengumuman</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Pengumuman, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Pengumuman di Universitas JimmyChandra.</p></div>
  
  
  <?php
  date_default_timezone_set('Asia/Jakarta');
  $tanggal = date("Y-m-d");
  $jam =  date("h:i:s");

  if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT * FROM pengumuman WHERE kode_pengumuman = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>
  
  <div class="isikonten">
<!--    <table class="tabel">
    <form method="post" > 
    <td>
    <tr><input name="kode_dosen" autocomplete="off" type="text"></input></tr>
    <tr><input name="nama_dosen" autocomplete="off" type="text"></input></tr>
    <tr><textarea name="annouce" autocomplete="off" rows="3"></textarea></tr>
    </form>
    </td>
    </table>
 -->
  <div class="tabel">
  <a href="manage_pengumuman.php">Kembali</a>
  </div>
  <h2>Form Tambah Pengumuman</h2>
  <form action="#" method="post">
  <table class="tabel" >
   <tbody><tr width="150">  
            <th>Kode Pengumuman :</th>
            <td><input name="kode_pengumuman" value="<?php echo $row1['kode_pengumuman'] ?>" autocomplete="off" type="text" size ="70"></input></td>
         </tr>
      <tr>
       <th>Kategori Pengumuman :</th>
       
            <td><select style="width:450px" name="kategori_pengumuman">
              <option value="" selected="">~~~ Silahkan Pilih Kategori ~~~</option>
              <option value="Informasi Akademik">Informasi Akademik</option>
              <option value="Kegiatan Mahasiswa">Kegiatan Mahasiswa</option>
              <option value="Seputar Registrasi">Seputar Registrasi</option>

          </select></td>
          </tr>
      
      <tr>
      <th>Judul Pengumuman :</th>
            <td><input name="judul_pengumuman" value="<?php echo $row1['judul_pengumuman'] ?>" autocomplete="off" type="text" size ="70"></input></td>
         </tr>
  
  <tr>
      <th>Tanggal Kirim :</th>
            <td><input name="tanggal_kirim" value="<?php echo $row1['tanggal_kirim'] ?>" autocomplete="off" type="date" size ="70" disabled></input></td>
    </tr>       
      <tr><th>Jam Kirim :</th>
            <td><input name="jam_kirim" value="<?php echo $row1['jam'] ?>" autocomplete="off" type="time" size ="70" disabled></input></td>
    </tr>    
     </tr>       
         

     <th colspan=2>
     Isi Pengumuman : 
    <textarea name="isipengumuman"  style="margin: 0px; width: 679px; height: 168px;"><?php echo $row1['isi_pengumuman'] ?></textarea>  
   </th>
      
  
        
    
       
    </tbody></table>
    <div class="isikonten">
    <center><input type="submit" name="submit" value="Submit"></center>
</div></form>
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
if(isset($_POST['submit']))
{
  // ini semua buat ambil data biar bisa dimasukkan ke database
  $kode_pengumuman = $_POST['kode_pengumuman'];
  $judul_pengumuman = $_POST['judul_pengumuman'];
  $kategori_pengumuman = $_POST['kategori_pengumuman'];
  $tanggal_kirim = $tanggal;
  $jam_kirim = date("h:i:s");
  $isipengumuman = $_POST['isipengumuman'];

 if ($kategori_pengumuman === "") {
      echo "<script> alert('Silahkan input Kategori Pengumuman!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_pengumuman.php">';
  }if ($judul_pengumuman === "") {
      echo "<script> alert('Silahkan input Judul Pengumuman!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_pengumuman.php">';
  }if ($isipengumuman === "") {
      echo "<script> alert('Silahkan input Isi Pengumuman!');</script>";
      echo'<META HTTP-EQUIV="Refresh" hw_ChildrenObj(connection, objectID)NTENT="0; URL=manage_pengumuman.php">';
  }if($kategori_pengumuman && $judul_pengumuman && $isipengumuman) {
  
  
    $query = mysqli_query($DBConn,"UPDATE pengumuman SET judul_pengumuman = '$judul_pengumuman', isi_pengumuman='$isipengumuman', tanggal_kirim='$tanggal_kirim', kategori='$kategori_pengumuman', jam='$jam_kirim' WHERE kode_pengumuman='$kode_pengumuman'");

    if($query){
     echo "<script> alert('Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_pengumuman.php">';
  }else{
      echo "<script> alert('koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_pengumuman.php">';
  } 
}else{
      echo "<script> alert('Not Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_pengumuman.php">';
  } 
}

?>