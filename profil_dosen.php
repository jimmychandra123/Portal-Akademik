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
<div class="menu">
	<div class="profil" >
		<p>Informasi Pengguna</p>
		<br>
		<img src="logoprofil.png" width="100px" height="100px">
		<br>
		<h1><?php echo $row['nama_dosen']; ?></h1>
		<h1><?php echo $row['kode_dosen']; ?></h1>
		<h1><?php echo $row['nama_prodi']; ?></h1>
		<a href="logout.php">Logout</a>
	</div>
<?php
include'menu-dosen.php';
?>
</div>

<!--  -->
<div class="konten">
	<h2>Profil Mahasiswa</br></h2>

	<div class="isikonten">
	<p>Keterangan :
			Profil Mahasiswa berisi data pribadi pengguna portal akademik. Apabila terdapat kesalahan data, anda dapat menghubungi bagian akademik untuk memperbaikinya.</p><br>
		<table class="tabel" >
   <h2>Form Biodata Mahasiswa</h2>
   <tbody><tr width="150"> 
      <th>NPM</th>
      <td><?php echo $row['kode_dosen'];?></td>
   </tr> 
         <tr> 
            <th>Nama</th>
            <td><?php echo $row['nama_dosen']; ?></td>
         </tr>
         <tr> 
            <th>Program Studi</th>
            <td><?php echo $row['nama_prodi']; ?></td>
         </tr>
         <tr> 
            <th>Tempat Tanggal Lahir</th>
            <td><?php echo $row['tempat_lahir']; ?>,&nbsp;<?php echo $row['tanggal_lahir']; ?></td>
         </tr>
         <tr> 
            <th>Agama</th>
            <td><?php echo $row['agama']; ?></td>
         </tr>
         <tr> 
            <th>Jenis Kelamin</th>
            <td><?php echo $row['gender']; ?></td>
         </tr>
         <tr> 
            <th>Status</th>
            <td><?php echo $row['status_aktif']; ?></td>
         </tr>   
   </tbody></table>
	</div>
</div>
<!--  -->



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