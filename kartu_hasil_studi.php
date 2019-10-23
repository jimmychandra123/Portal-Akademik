<?php
  session_start();
include 'koneksi.php';
  if(!isset($_SESSION["MahasiswaID"]))
  {
    header("Location: index.php");
  };

  $sql = "SELECT mahasiswa.*, programstudi.*, semester.semester FROM mahasiswa INNER JOIN programstudi ON mahasiswa.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON mahasiswa.kode_semester = semester.kode_semester WHERE npm = '" . $_SESSION['MahasiswaID'] . "'";
  $result = $DBConn->query($sql);
  $row = $result->fetch_assoc();
$nprd =  $row['kode_prodi'];
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
	<h2>Form List Kartu Hasil Studi</br></h2>

	<div class="isikonten">
	<p>Keterangan : </br>
   Kartu Hasil Studi merupakan fasilitas yang dapat digunakan untuk melihat hasil studi mahasiswa persemester. Selain dapat dilihat secara online, hasil studi ini juga dapat dicetak.</p><br><br>
	   <table class="tabel">
   <tbody><tr width="150"> 
          <th>NPM</th>
            <td><?php echo $row['npm']; ?></td>
           </tr> 
         <tr> 
            <th>Nama</th>
            <td><?php echo $row['nama']; ?></td>
         </tr>
         <tr> 
            <th>Program Studi</th>
            <td><?php echo $row['nama_prodi']; ?></td>
         </tr>
         <tr> 
            <th>Semester</th>
            <td><?php echo $row['semester'];?></td>
         </tr>
         <tr> 
            <th>Maksimum SKS</th>
            <td>24</td>
         </tr>
            
   </tbody></table><br>

    <table class="tabel">
      <form action="#" method="get">
  <tr>
          <th align="left">Semester : &nbsp;
          </th><td align="left">
            <select style="width:450px" name="kode_semester">
             <option value="" selected>~~~ Silahkan Pilih Semester ~~~</option>
          <?php
          $psql = "SELECT * FROM `semester`";
          $presult = $DBConn->query($psql);
          while ($prow = $presult->fetch_assoc()) {
          ?>
                      
                      <option value="<?php echo $prow['kode_semester'] ?>" ><?php echo $prow['semester'] ?></option>
           <?php
        }
        ?>               
          </select>
          </td>
          <td align="left"><input type="submit" name="lihat" value="lihat"></td>
    
      
       </tr>
     </form>
   </table>
   <table class='tabel'>
      <H2>Form Lihat Kartu Hasil Studi</H2>
       <tbody><tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Jadwal</th>
                <th>Sks</th>
                <th>Nilai</th>
            </tr>
        <?php 
        if (isset($_GET['lihat'])) {
        $kdsem= $_GET['kode_semester'];
        $id = $row['npm'];
        $dsql1 = "SELECT kelas.*, matakuliah.*, programstudi.*, semester.*, jadwal.*, ruangkelas.*, dosen.*, karturencanastudi.*  FROM jadwal INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang INNER JOIN karturencanastudi ON jadwal.kode_jadwal = karturencanastudi.kode_jadwal WHERE jadwal.kode_prodi ='$nprd' And jadwal.kode_semester='$kdsem' And karturencanastudi.npm='$id'";
      $result1 = $DBConn->query($dsql1);
      
      if ($result1->num_rows > 0) 
      {
        // output data of each row
        $i = 1; 
        while($row1 = $result1->fetch_assoc()) 

        {
        ?>    
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td><p><?php echo $row1['kode_matkul'] ?></p></td>
                <td><p><?php echo $row1['nama_matkul'] ?></p></td>
                <td><p><?php echo $row1['nama_kelas'] ?></p></td>
                <td><p><?php echo $row1['jumlah_sks'] ?></p></td>
                <td><?php echo $row1['nilai'] ?></td>
            
            </tr>

            </tbody>
        <?php $i++; 
  

           $sem =  $row1['semester'];     
                $sumsql = "SELECT SUM(matakuliah.jumlah_sks)AS totalsks, count(matakuliah.kode_matkul) AS totalmatkul FROM karturencanastudi INNER JOIN jadwal on karturencanastudi.kode_jadwal = jadwal.kode_jadwal INNER JOIN matakuliah on jadwal.kode_matkul = matakuliah.kode_matkul WHERE karturencanastudi.semester='$sem' AND karturencanastudi.npm='" . $_SESSION['MahasiswaID'] . "'";
                 $resultsum = $DBConn->query($sumsql);
                 $rowsum = $resultsum->fetch_assoc();
              }    
            ?>
                <tr>
                <td colspan="5" align="right"><b>Total SKS diambil&nbsp;&nbsp;&nbsp;</b></td>
                <td align="center"><b><?php echo $rowsum['totalsks'];?></b></td></tr>
                  <tr>
                <td colspan="5" align="right"><b>Total Matakuliah diambil&nbsp;&nbsp;&nbsp;</b></td>
                <td align="center"><b><?php echo $rowsum['totalmatkul'];?></b></td></tr>


    <?php  }
    }?>


    </table>
  
  </div>
</div>
<!--  -->



<!--  -->
<div class="footer">
	<h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>	
© 2019 - 2030. All Right Reserved</h2>	
</div>
</div>
</body>
</html>


