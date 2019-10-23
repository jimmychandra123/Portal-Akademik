<?php
  session_start();
include 'koneksi.php';
  if(!isset($_SESSION["MahasiswaID"]))
  {
    header("Location: index.php");
  };

  $sql = "SELECT mahasiswa.*, programstudi.nama_prodi, semester.semester FROM mahasiswa INNER JOIN programstudi ON mahasiswa.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON mahasiswa.kode_semester = semester.kode_semester WHERE npm = '" . $_SESSION['MahasiswaID'] . "'";
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
<div class="menu">
	<div class="profil" >
		<p>Informasi Pengguna</p>
		<br>    
		<img src="logoprofil.png" width="100px" height="100px">
		<br>
		<h1><?php echo $row['nama']; ?></h1>
		<h1><?php echo $row['npm']; ?></h1>
		<h1><?php echo $row['nama_prodi']; ?></h1>
		<a href="logout.php">Logout</a>
	</div>
<br><h2>Akademik</h2>
<nav >
 <a href="halaman_mahasiswa.php">Halaman Depan</a> 
 <a href="panduan_mahasiswa.php">Panduan</a> 
 <a href="profil_mahasiswa.php">Profil</a> 
 <a href="informasi_matakuliah.php">Informasi Matakuliah</a> 
 <a href="kartu_rencana_studi.php">Kartu Rencana Studi</a> 
 <a href="kartu_hasil_studi.php">Kartu Hasil Studi</a> 
 <a href="transkrip_nilai.php">Transkrip Nilai</a>  
<a href="ubah_password.php">Ubah Password</a>
 <br>
 <br><h2>Kelas</h2>
 <a href="materi_kuliah.php">Materi Kuliah</a> 
 <a href="pengunguman.php">Pengumuman</a> 
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
            <td><input name="passwordbaru"  type="password"></td>
         </tr>
         <tr>
            <th>Tulis Ulang Password baru</th>
            <td><input name="konfirmasipasswordbaru" type="password"></td>
         </tr>
         <tr>
            <td></td>
            <td><input  type="submit" name="simpan" id="Simpan" value="Simpan"></td>
         </tr>
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
  $check = mysqli_query($DBConn,"SELECT * FROM mahasiswa WHERE npm = '".$_SESSION['MahasiswaID']."' AND password = '$passwordlama'");
  $count = mysqli_num_rows($check);
  if($count > 0)
  {
    if ($konfirmasipasswordbaru == $passwordbaru)
    {
    $qryEdit = "UPDATE mahasiswa SET password = '$passwordbaru' WHERE npm= ?";
    $stmtUpdUser = $DBConn->prepare($qryEdit);
    $stmtUpdUser->bind_param("s",$_SESSION['MahasiswaID']);
    $stmtUpdUser->execute();
    echo "<script> alert('Password anda telah berhasil diperbarui!'); window.location.href ='ubah_password.php'; </script>";
    }else
    {
      echo "<script> alert('Silahkan Cek kembali data anda!'); window.location.href ='ubah_password.php'; </script>";
    }
}
else {
   echo "<script> alert('Password anda tidak berhasil di perbarui'); window.location.href ='ubah_password.php'; </script>";
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