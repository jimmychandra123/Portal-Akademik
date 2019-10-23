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
		<h1><?php echo $row['nama']; ?></h1>
		<h1><?php echo $row['npm']; ?></h1>
		<h1><?php echo $row['nama_prodi']; ?></h1>
		<a href="logout.php">Logout</a>
	</div>
<br><h2>Akademik</h2>
<?php
include'menu-mahasiswa.php';
?>

</div>

<div class="konten">
	<h2>Selamat Datang <?php echo $row['nama']; ?></h2><br>
	<div class="isikonten">
		
		<p>Selamat Datang di Portal Akademik Universitas JimmyChandra.
			dengan adanya portal akademik ini, semoga dapat membantu para civitas akademika 
			untuk mengakses dan mendapat informasi akademik lebih cepat melalui internet.
			Portal  Akademik ini juga diharapkan agar mempermudah para civitas akademika
			dalam kegiatan belajar dan mengajar. Selamat menggunakan sistem portal ini.</p>
	</div>
</div>


<div class="konten">
	<h2>Pengumuman</h2><br>
<div class="pengumuman">
	<a href="#">Kategori : Informasi Akademik</a></br></br>
<?php 
$halaman = 7;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik'");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row = mysqli_fetch_assoc($query)) {
?>
	
	<a href="viewpengumuman.php?id=<?php echo $row['kode_pengumuman'] ?>"><?php echo $row['judul_pengumuman'] ?>:  <?php echo $row['tanggal_kirim'] ?> <?php echo $row['jam'] ?></br>
				<hr></a><br><br>
<?php
	}
?>		


  <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <b><a href="?halaman=<?php echo $i; ?>">[<?php echo $i;  ?>]	</a></b>

  <?php } ?></center>

</div>
<div class="pengumuman2">
	<a href="#">Kategori : Kegiatan Mahasiswa</a></br></br>
<?php 
	$halaman = 7;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Kegiatan Mahasiswa'");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Kegiatan Mahasiswa' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row2 = mysqli_fetch_assoc($query)) {
?>
	
	<a href="viewpengumuman.php?id=<?php echo $row2['kode_pengumuman'] ?>"><?php echo $row2['judul_pengumuman'] ?>:  <?php echo $row2['tanggal_kirim'] ?> <?php echo $row2['jam'] ?></br>
				<hr></a><br><br>
	<?php
	}
	?>  <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <b><a href="?halaman=<?php echo $i; ?>">[<?php echo $i;  ?>]	</a></b>

  <?php } ?></center>		
</div>
<div class="pengumuman3">
	<a href="#">Kategori : Seputar Registrasi</a></br></br>

	<?php 
	$halaman = 7;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Seputar Registrasi'");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Seputar Registrasi' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row3 = mysqli_fetch_assoc($query)) {
?>	
	<a href="viewpengumuman.php?id=<?php echo $row3['kode_pengumuman'] ?>"><?php echo $row3['judul_pengumuman'] ?>:  <?php echo $row3['tanggal_kirim'] ?> <?php echo $row3['jam'] ?></br>
				<hr></a><br><br>
	<?php
	}
	?>	 <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <b><a href="?halaman=<?php echo $i; ?>">[<?php echo $i;  ?>]	</a></b>

  <?php } ?></center>	
</div>

</div>


<div class="footer">
	<h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>	
© 2019 - 2030. All Right Reserved</h2>	
</div>


</div>





</body>
</html>