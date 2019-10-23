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
  <h2>Manage Data Kelas</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Kelas, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Kelas yang terdaftar di Universitas JimmyChandra.</p></div>
  
  
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
  <a href="manage_kelas.php">Kembali</a>
  </div>
  <h2>Form Tambah Kelas</h2>
  <form action="#" method="post">
  <table class="tabel" >
   <tbody><tr width="150">  
            <th>Kode Kelas :</th>
            <td><input name="kode_kelas" autocomplete="off" type="text" size ="70"></input></td>
         </tr>
       <tr>

      <th>Nama Kelas :</th>
            <td><input name="nama_kelas" autocomplete="off" type="text" size ="70"></input></td>
         </tr>
       
        
    <tr>
            <th>Program Studi :</th>
            <td >

            <select style="width:450px" name="kode_prodi">
             <option value="" selected="">~~~ Silahkan Pilih Program Studi ~~~</option>
          <?php
          $psql = "SELECT * FROM `programstudi`";
          $presult = $DBConn->query($psql);
          while ($prow = $presult->fetch_assoc()) {
          ?>
                      
                      <option value="<?php echo $prow['kode_prodi'] ?>" ><?php echo $prow['nama_prodi'] ?></option>
           <?php
        }
        ?>               
          </select>
        
          </td>
      </tr>
       <tr>
       <th>Semester :</th>
       
            <td><select style="width:450px" name="semester">
            
            <option value="" selected="">~~~ Silahkan Pilih Semester ~~~</option>
            <?php
            $ssql = "SELECT * FROM `semester`";
            $sresult = $DBConn->query($ssql);
            while ($srow = $sresult->fetch_assoc()) {
            ?>
                        
                  <option value="<?php echo $srow['kode_semester'] ?>" ><?php echo $srow['semester'] ?></option>
             <?php
          }
          ?>               

          </select></td>
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
  $nama_kelas = $_POST['nama_kelas'];
  $kode_semester = $_POST['semester'];
  $kode_prodi = $_POST['kode_prodi'];

          if ($kode_kelas === "") {
                  echo "<script> alert('Silahkan input Kode Kelas!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
           }if ($nama_kelas === "") {
                  echo "<script> alert('Silahkan input Nama Kelas!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
          }if ($kode_prodi === "") {
                  echo "<script> alert('Silahkan input Nama Prodi!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
          }if ($kode_semester === "") {
                  echo "<script> alert('Silahkan input Semester!');</script>";
                  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
          }if($kode_kelas && $nama_kelas && $kode_prodi && $kode_semester) 
          {
  
    $query = mysqli_query($DBConn,"INSERT INTO kelas(kode_kelas, nama_kelas, kode_prodi, kode_semester) VALUES ('$kode_kelas','$nama_kelas','$kode_prodi','$kode_semester')");

    if($query){   echo "<script> alert('Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_kelas.php">';
  
  }else{
    echo "<script> alert('Koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
  }
 }else{
    echo "<script> alert('Not Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_kelas.php">';
  }
}

?>