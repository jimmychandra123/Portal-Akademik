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
<?php
include'menu-mahasiswa.php';
?>
</div>

<!--  -->
<div class="konten">
	<h2>Informasi Matakuliah Ditawarkan</br></h2>

	<div class="isikonten">
	<p>Keterangan : </br>
Informasi Matakuliah Ditawarkan berisi seluruh matakuliah yang ditawarkan pada semester aktif. Dari seluruh matakuliah yang terdapat pada daftar, setiap matakuliah mempunyai aturan tersendiri bergantung pada program studi, kurikulum, dan aturan akademik lainnya. Untuk lebih jelasnya, anda dapat melihat detil kelas.</p><br><br>
  
	<table class="tabel">
  
  <form action="#" method="get">
  <tr>
          <th align="left">Program Studi&nbsp;
          </th><td align="left">
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
          <td align="left"><input type="submit" name="lihat" value="lihat"></td>
    
      
       </tr>
     </form>
</table>
<br>
  <table class="tabel">
   
      <?php
      if (isset($_GET['kode_prodi'])) {

      $prodi = $_GET['kode_prodi'];
       $sql1 = "SELECT matakuliah.*,programstudi.* FROM matakuliah INNER JOIN programstudi on matakuliah.kode_prodi = programstudi.kode_prodi  WHERE matakuliah.kode_prodi = '$prodi'";
       $result1 = $DBConn->query($sql1);
       $row1 = $result1->fetch_assoc();
      ?>
     <H2>Mata Kuliah <?php echo $row1['nama_prodi']; ?> yang ditampilkan</H2>
         <tbody>
         <tr>
            <th>Kode Matkul</th>
            <th>Nama Matkul</th>
            <th>Semester</th>
            <th>Sks</th>
         
            </tr>

            <?php }; ?>
      <?php
      if (isset($_GET['kode_prodi'])) {
      $prodi2 = $_GET['kode_prodi'];
       $sql2 = "SELECT matakuliah.*,semester.*,programstudi.* FROM matakuliah INNER JOIN programstudi on matakuliah.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON matakuliah.kode_semester = semester.kode_semester WHERE matakuliah.kode_prodi = '$prodi'  ORDER BY semester.semester,matakuliah.nama_matkul ASC";
       $result2 = $DBConn->query($sql2);
       while($row2 = $result2->fetch_assoc())
       {       
       ?>
       

            <tr>
                <td align="center"><?php echo $row2['kode_matkul']; ?></td>
                <td><?php echo $row2['nama_matkul']; ?></td>
                <td><?php echo $row2['semester']; ?></td>
                <td><?php echo $row2['jumlah_sks']; ?></td>
            </tr>
   
        
          
         <?php
       };
       };
         ?>
         </tbody>
  </table>

  <div>
    <br>
  
  </div>
  <br>

  </div>
	</div>
<div class="footer">
  <h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>  
© 2019 - 2030. All Right Reserved</h2>  
</div>
</div>
<!--  -->



<!--  -->

<!--  -->

</div>
<!--  -->




</body>
</html>