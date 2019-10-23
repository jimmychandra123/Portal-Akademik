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
  <h2>Manage Data Jadwal Kelas</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Jadwal Kelas, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Jadwal Kelas yang terdaftar di Universitas JimmyChandra.</p></div>
  
  
  <div class="isikonten">
<?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT kelas.*, matakuliah.*, programstudi.*, semester.*, jadwal.*, ruangkelas.* FROM jadwal INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang WHERE jadwal.kode_jadwal = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>
  <div class="tabel">

  <a href="view_jadwalperprodi.php?id=<?php echo $row1['kode_prodi'] ?>">Kembali</a></div>
  <h2>Form Edit Jadwal Kelas, Prodi <?php echo $row1['nama_prodi'] ?></h2>
  <form action="#" method="post">
  <table class="tabel" >
   <tbody><tr width="150">  
            <th>Kode Jadwal :</th>
            <td><input name="kode_jadwal"  value="<?php echo $row1['kode_jadwal'] ?>"  autocomplete="off" type="text" size ="70" disabled></input></td>
         </tr>  
       <tr>
      <tr>
            <th>Program Studi :</th>
        <td><input name="nama_prodi"  value="<?php echo $row1['nama_prodi'] ?>"  autocomplete="off" type="text" size ="70" disabled></input></td></tr>
           <tr>
            <th>Semester :</th>
        <td><input name="nama_matkul"  value="<?php echo $row1['semester'] ?>"  autocomplete="off" type="text" size ="70" disabled></input></td></tr>  


      <th>Nama Kelas :</th>
            <td>  <select style="width:450px" name="kode_kelas">
             <option value="" selected>~~~ Silahkan Pilih Kelas ~~~</option>
          <?php
          $psql = "SELECT * FROM `kelas` where kode_prodi = '".$row1['kode_prodi']."' AND  kode_semester='".$row1['kode_semester']."'";
          $presult = $DBConn->query($psql);
          while ($prow = $presult->fetch_assoc()) {
          ?>
                      
                      <option value="<?php echo $prow['kode_kelas'] ?>" ><?php echo $prow['nama_kelas'] ?></option>
           <?php
        }
        ?>               
          </select></td>
         </tr>
       
     

        <tr>
       <th>Ruang Kelas :</th>
       
            <td><select style="width:450px" name="kode_ruang">
            
            <option value="" selected>~~~ Silahkan Pilih Ruangan ~~~</option>
            <?php
            $ssql = "SELECT * FROM `ruangkelas`";
            $sresult = $DBConn->query($ssql);
            while ($srow = $sresult->fetch_assoc()) {
            ?>
                        
                  <option value="<?php echo $srow['kode_ruang'] ?>" ><?php echo $srow['nama_ruang'] ?> (<?php echo $srow['kategori'] ?>)</option>
             <?php
          } 
          ?>               

          </select></td>
          </tr>

 
       <tr>
       <th>Dosen yang Mengajar :</th>
       
            <td><select style="width:450px" name="kode_dosen">
            
            <option value="" selected>~~~ Silahkan Pilih Dosen ~~~</option>
            <?php
            

            $ssql = "SELECT * FROM `dosen` WHERE kode_prodi='".$row1['kode_prodi']."'";
            $sresult = $DBConn->query($ssql);
            while ($srow = $sresult->fetch_assoc()) {
            ?>
                        
                  <option value="<?php echo $srow['kode_dosen'] ?>" ><?php echo $srow['nama_dosen'] ?></option>
            
        <?php

        
        }
          ?> 

           </select></td>
          </tr>
       
       <tr>
       <th>Matakuliah :</th>
       
            <td><select style="width:450px" name="kode_matkul">
            
            <option value="" selected>~~~ Silahkan Pilih Matakuliah ~~~</option>
            <?php
            $ssql = "SELECT * FROM `matakuliah` WHERE kode_prodi='".$row1['kode_prodi']."' AND  kode_semester='".$row1['kode_semester']."'";
            $sresult = $DBConn->query($ssql);
            while ($srow = $sresult->fetch_assoc()) {
            ?>
                        
                  <option value="<?php echo $srow['kode_matkul'] ?>" ><?php echo $srow['nama_matkul'];?> (Semester <?php  echo $row1['semester'];?>)</option>
             <?php
          }
          ?>              
          </select></td>
          </tr>




          <th>Hari :</th>

          <td><select value="" style="width:450px" name="hari">

          <option selected>~~~ Silahkan Pilih Hari ~~~</option>
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>                   
          </select></td>
          </tr>

          <tr>
          <th>Jam Masuk :</th>

        <td><input name="jam_mulai" value="<?php echo $row1['jam_mulai'] ?>"  autocomplete="off" type="time" size ="70"></input></td>
          </tr>
           <tr>
          <th>Jam Selesai :</th>

        <td><input name="jam_selesai" value="<?php echo $row1['jam_selesai'] ?>" autocomplete="off" type="time" size ="70"></input></td>
          </tr>
       
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
  $kode_kelas = $_POST['kode_kelas'];
  $kode_ruang = $_POST['kode_ruang'];
  $kode_dosen = $_POST['kode_dosen'];
  $kode_matkul = $_POST['kode_matkul'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  
if ($kode_kelas === "") {
      echo "<script> alert('Silahkan input Nama Kelas!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($kode_ruang === "") {
      echo "<script> alert('Silahkan input Ruang Kelas!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($kode_dosen === "") {
      echo "<script> alert('Silahkan input Nama Dosen!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($kode_matkul === "") {
      echo "<script> alert('Silahkan input Nama Matakuliah!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($hari === "") {
      echo "<script> alert('Silahkan input Hari!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($jam_mulai === "") {
      echo "<script> alert('Silahkan input Jam Mulai!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if ($jam_selesai === "") {
      echo "<script> alert('Silahkan input Jam Selesai!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }if($kode_kelas && $kode_ruang && $kode_dosen && $kode_matkul && $hari && $jam_mulai && $jam_selesai) {

    $query = mysqli_query($DBConn,"UPDATE jadwal SET kode_dosen='$kode_dosen', kode_ruang='$kode_ruang',kode_kelas='$kode_kelas',hari='$hari', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', kode_matkul='$kode_matkul' WHERE kode_jadwal='$id'");

    if($query){
     echo "<script> alert('Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }else{
      echo "<script> alert('Not Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }
}else{
      echo "<script> alert('Not Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_jadwal.php">';
  }
}
?>