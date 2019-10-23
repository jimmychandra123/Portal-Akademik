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
	<h2>Manage Data Dosen</h2>
	<div class="isikonten">
		<p>Keterangan : </br>
			Manage Data Dosen, hanya dapat digunakan oleh admin untuk menambah dan mengedit data Dosen di Universitas JimmyChandra.</p>
	</div>
	
	
	<div class="isikonten">
<!-- 		<table class="tabel">
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
	<a href="manage_dosen.php">Kembali</a>
	</div>
	<h2>Form Tambah Dosen</h2>
 	<form action="proses_adddosen.php" method="post">
 	<table class="tabel" >
   <tbody><tr width="150">  
            <th>Kode Dosen :</th>
            <td><input name="kode_dosen" autocomplete="off" type="text" size ="70"></input></td>
         	<input name="password_dosen" autocomplete="off" type="hidden" value="123456" size ="50">
         	<input name="status" autocomplete="off" type="hidden" value="Aktif" size ="50">
         </tr>
         <tr> 
            <th>Nama Dosen :</th>
            <td><input name="nama_dosen" autocomplete="off" type="text" size ="70"></input></td>
         </tr>
         <tr>
            <th>Program Studi :</th>
            <td >

            <select style="width:450px" name="kode_prodi">
             <option value="" selected>~~~ Silahkan Pilih Program Studi ~~~</option>
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
            <th>Tempat Lahir :</th>
            <td><input name="tempat_lahir_dosen" autocomplete="off" type="text" size ="70" placeholder="Batam-Kepri,Indonesia"></input></td>
         </tr>
         <tr> 
            <th>Tanggal Lahir : </th>
            <td><input name="tanggal_lahir_dosen" autocomplete="off" type="date" size ="70" placeholder="yyyy-mm-dd"></input></td>
         </tr>
         <tr> 
            <th>Agama</th>
            <td><select style="width:450px" name="agama">
              <option value="" selected="">~~~ Silahkan Pilih Agama ~~~</option>
              <option value="Buddha">Buddha</option>
              <option value="Hindu">Hindu</option>
              <option value="Islam">Islam</option>
              <option value="Katolik">Katolik</option>
              <option value="Kristen">Kristen</option>
        	</select></td>
         </tr>
         	<tr> 
            <th>Jenis Kelamin :</th> 
            <td>
             <select style="width:450px" name="gender">
              <option value="" selected="">~~~ Silahkan Pilih Jenis Kelamin ~~~</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
        	</select>
			</td>
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

