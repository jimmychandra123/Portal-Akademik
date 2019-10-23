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
	<h2>Manage Data Mahasiswa</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Mahasiswa, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Mahasiswa yang terdaftar di Universitas JimmyChandra.</p>
  </div>


	<div class="isikonten">
		<div class="tabel">
	<a href="add_mahasiswa.php">Tambah Mahasiswa</a>
	</div>
		<h2>Form List Mahasiswa</h2><table class="tabel">
	
			<tr>
				<td>NPM</td>
				<td>Nama Mahasiswa</td>
				<td>Program Studi</td>
				<td>Semester</td>
				<td>Jenis Kelamin</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
	<?php 
      $msql = "SELECT mahasiswa.*, programstudi.nama_prodi, semester.semester FROM mahasiswa INNER JOIN programstudi ON mahasiswa.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON mahasiswa.kode_semester = semester.kode_semester ORDER BY mahasiswa.npm ASC";
	  $result = $DBConn->query($msql);
		  
	  if ($result->num_rows > 0) 
	  {
		  // output data of each row
		  while($row = $result->fetch_assoc()) 
		  {
?>
			<tr>
				<td><?php echo $row['npm'] ?></td>
				<td><?php echo $row['nama'] ?></td>
				<td><?php echo $row['nama_prodi'] ?></td>
				<td><?php echo $row['semester'] ?></td>
				<td><?php echo $row['gender'] ?></td>
				<td><?php echo $row['status_aktif'] ?></td>
				<td><a href="view_mahasiswa.php?id=<?php echo $row['npm'] ?>">&ensp; View</a> || <a href="edit_mahasiswa.php?id=<?php echo $row['npm'] ?>">Edit</a></td>
			</tr>
			<?php
		}
	}
	?>
		</table>

	</div>
</div>





<div class="footer">
	<h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>	
© 2019 - 2030. All Right Reserved</h2>
</div>


</div>





</body>
</html>