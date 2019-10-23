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
<!--  -->
<div class="wrapper">
<!--  -->
<div class="header">
<img src="logojc.png" width="1000px" height="150px">
</div>
<!--  -->
<<div class="menu">
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
<!--  -->
<div class="konten">
	<h2>Ubah Password</br></h2>

	<div class="isikonten">
	<p>Keterangan : </br>
Ubah Password dapat digunakan untuk merubah password lama menjadi password baru. Jika anda lupa password anda, silahkan menghubungi bagian akademik untuk mendapatkan password baru.</p>
	<div class="isikonten">
    <form action="#" method="post">
   <h2>Form Ubah Password</h2>
   <table class="tabel" width="100%">
         <tbody>
         <tr>
            <th>Password lama</th>
            <td><input name="passwordlama" type="password"></td>
         </tr>
         <tr>
            <th>Password baru</th>
            <td><input name="passwordbaru" id="passwd1" type="password"></td>
         </tr>
         <tr>
            <th>Tulis Ulang Password baru</th>
            <td><input name="konfirmasipasswordbaru" id="passwd2" type="password"></td>
         </tr>
         <center><tr>
            
            <td colspan="2"><input  type="submit" name="simpan" id="Simpan" value="Simpan"></td>
         </tr></center>
      </tbody></table></form>
   </div>
	</div>
</div>
<!--  -->

<?php
  if(isset($_POST['simpan'])) {
  $passwordlama = $_POST['passwordlama'];
  $passwordbaru = $_POST['passwordbaru'];
  $konfirmasipasswordbaru = $_POST['konfirmasipasswordbaru'];

  $check = mysqli_query($DBConn,"SELECT * FROM admin WHERE kode_admin = '".$_SESSION['AdminID']."' AND password = '$passwordlama'");
  $count = mysqli_num_rows($check);
  if($count > 0)
  {
       if ($passwordlama && $passwordbaru && $konfirmasipasswordbaru){
    $qryEdit = "UPDATE admin SET password = '$passwordbaru' WHERE kode_admin= ?";
    $stmtUpdUser = $DBConn->prepare($qryEdit);
    $stmtUpdUser->bind_param("s",$_SESSION['AdminID']);
    $stmtUpdUser->execute();
    echo "<script> alert('Password anda telah berhasil diperbarui!'); window.location.href ='halaman_admin.php'; </script>";
    }else
    {
      echo "<script> alert('Silahkan Cek kembali data anda!'); window.location.href ='ubah_passwordadmin.php'; </script>";    
    }
}
else {
   echo "<script> alert('Password anda tidak berhasil di perbarui'); window.location.href ='ubah_passwordadmin.php'; </script>";

}
}
       ?>


<!--  -->
<div class="footer">
	<h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>	
© 2019 - 2030. All Right Reserved</h2>	
</div>
<!--  -->

</div>
<!--  -->




</body>
</html>