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
		<a href="logout.php">Logout</a>
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
	<h2>Selamat Datang <?php echo $row['nama_admin']; ?></h2><br>
	<div class="isikonten">
		
		<p>Selamat Datang di Portal Akademik Universitas JimmyChandra.
			dengan adanya portal akademik ini, semoga dapat membantu para civitas akademika 
			untuk mengakses dan mendapat informasi akademik lebih cepat melalui internet.
			Portal  Akademik ini juga diharapkan agar mempermudah para civitas akademika
			dalam kegiatan belajar dan mengajar. Selamat menggunakan sistem portal ini.</p>
	</div>
</div>


<div class="konten">
	<h2>Pengunguman</h2><br>
<div class="pengumuman">
	<a href="#">Kategori : Informasi Akademik</a></br></br>
<?php 
$halaman = 5;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik' ");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row = mysqli_fetch_assoc($query)) {







	  // $psql = "SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik'";
	  // $result = $DBConn->query($psql);
	  
	  // if ($result->num_rows > 0) 
	  // {
		 //  // output data of each row
		 //  while($row = $result->fetch_assoc()) 
		 //  {
?>
	
	<a href="viewpengumumanadmin.php?id=<?php echo $row['kode_pengumuman'] ?>"><?php echo $row['judul_pengumuman'] ?>:  <?php echo $row['tanggal_kirim'] ?> <?php echo $row['jam'] ?></br>
				<hr></a><br><br>
<?php
	}
?>		


  <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>">(<?php echo $i;  ?>)	</a>

  <?php } ?></center>

</div>
<div class="pengumuman2">
		<a href="#">Kategori : Kegiatan Mahasiswa</a></br></br>
<?php 
$halaman = 5;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Kegiatan Mahasiswa'");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Kegiatan Mahasiswa' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row = mysqli_fetch_assoc($query)) {







	  // $psql = "SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik'";
	  // $result = $DBConn->query($psql);
	  
	  // if ($result->num_rows > 0) 
	  // {
		 //  // output data of each row
		 //  while($row = $result->fetch_assoc()) 
		 //  {
?>
	
	<a href="viewpengumumanadmin.php?id=<?php echo $row['kode_pengumuman'] ?>"><?php echo $row['judul_pengumuman'] ?>:  <?php echo $row['tanggal_kirim'] ?> <?php echo $row['jam'] ?></br>
				<hr></a><br><br>
<?php
	}
?>		


  <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>">(<?php echo $i;  ?>)	</a>

  <?php } ?></center>
</div>
<div class="pengumuman3">
	<a href="#">Kategori : Seputar Registrasi</a></br></br>
<?php 
$halaman = 5;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Seputar Registrasi'");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysqli_query($DBConn,"SELECT * FROM `pengumuman` WHERE Kategori ='Seputar Registrasi' LIMIT $mulai, $halaman")or die(mysql_error);
	while ($row = mysqli_fetch_assoc($query)) {







	  // $psql = "SELECT * FROM `pengumuman` WHERE Kategori ='Informasi Akademik'";
	  // $result = $DBConn->query($psql);
	  
	  // if ($result->num_rows > 0) 
	  // {
		 //  // output data of each row
		 //  while($row = $result->fetch_assoc()) 
		 //  {
?>
	
	<a href="viewpengumumanadmin.php?id=<?php echo $row['kode_pengumuman'] ?>"><?php echo $row['judul_pengumuman'] ?>:  <?php echo $row['tanggal_kirim'] ?> <?php echo $row['jam'] ?></br>
				<hr></a><br><br>
<?php
	}
?>		


  <center><?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>">(<?php echo $i;  ?>)	</a>

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