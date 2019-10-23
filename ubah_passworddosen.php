<?php
  session_start();
include 'koneksi.php';
  if(!isset($_SESSION["DosenID"]))
  {
    header("Location: index.php");
  };

 
  $sql = "SELECT dosen.*, programstudi.nama_prodi FROM dosen INNER JOIN programstudi ON dosen.kode_prodi = programstudi.kode_prodi WHERE kode_dosen = '" . $_SESSION['DosenID'] . "'";
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
    <h1><?php echo $row['nama_dosen']; ?></h1>
    <h1><?php echo $row['kode_dosen']; ?></h1>
    <h1><?php echo $row['nama_prodi']; ?></h1>
    <a href="index.php">Logout</a>
  </div>
<?php
include'menu-dosen.php';
?>
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

  $check = mysqli_query($DBConn,"SELECT * FROM dosen WHERE kode_dosen = '".$_SESSION['DosenID']."' AND password = '$passwordlama'");
  $count = mysqli_num_rows($check);
  if($count > 0)
  {
       if ($passwordlama && $passwordbaru && $konfirmasipasswordbaru){
    $qryEdit = "UPDATE dosen SET password = '$passwordbaru' WHERE kode_dosen= ?";
    $stmtUpdUser = $DBConn->prepare($qryEdit);
    $stmtUpdUser->bind_param("s",$_SESSION['DosenID']);
    $stmtUpdUser->execute();
    echo "<script> alert('Password anda telah berhasil diperbarui!'); window.location.href ='halaman_dosen.php'; </script>";
    }else
    {
      echo "<script> alert('Silahkan Cek kembali data anda!'); window.location.href ='ubah_passworddosen.php'; </script>";    
    }
}
else {
   echo "<script> alert('Password anda tidak berhasil di perbarui'); window.location.href ='ubah_passworddosen.php'; </script>";

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