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
	<h2>Tambah Kartu Rencana Studi</br></h2>

	<div class="isikonten">
	<p>Keterangan : </br>
Add Kartu Rencana Studi merupakan fasilitas pengisian KRS secara online. Fasilitas KRS Online ini hanya dapat digunakan pada saat masa KRS atau masa revisi KRS. Mahasiswa dapat memilih matakuliah yang ingin diambil bersesuaian dengan jatah sks yang dimiliki dan matakuliah yang ditawarkan. Setelah melakukan pengisian KRS mahasiswa dapat mencetak KRS tersebut agar dapat ditandatangani oleh dosen pembimbingnya masing-masing.</p><br><br>
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
   <br>
   <table class='tabel'>
      <H2>Form Tambah Kartu Rencana Studi</H2>
      <form action="#" method="post">
       <tbody><tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Jadwal</th>
                <th>Sks</th>
            </tr>
        <?php 
        if (isset($_GET['lihat'])) {
        $kdsem= $_GET['kode_semester'];
        $dsql1 = "SELECT kelas.*, matakuliah.*, programstudi.*, semester.*, jadwal.*, ruangkelas.*, dosen.* FROM jadwal INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang WHERE jadwal.kode_prodi ='$nprd' And jadwal.kode_semester='$kdsem'";
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
                <td><input type="checkbox" name="kodejadwal[]" value="<?php echo $row1['kode_jadwal'] ?>"><?php echo $row1['nama_kelas'] ?></td>
                <td><p><?php echo $row1['nama_matkul'] ?></p></td>

                <td><?php echo $row1['hari'] ?>, <?php echo $row1['jam_mulai'] ?> - <?php echo $row1['jam_selesai'] ?> (<?php echo $row1['nama_ruang'] ?>)</td>
                <td align="center"><?php echo $row1['jumlah_sks'] ?></td>
            </tr>
            </tbody>
        <?php $i++; 
      }
      }
    }?>
</table>
      <div class="isikonten">
    <center><input type="submit" name="submit" value="Submit"></center>
</div>
      </form>
  
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



<?php

$kdsem2= $_GET['kode_semester'];
$dsql2 = "SELECT semester.* from jadwal INNER JOIN semester on jadwal.kode_semester = semester.kode_semester
WHERE jadwal.kode_semester='$kdsem2'";
$result2 = $DBConn->query($dsql2);
$row2 = $result2->fetch_assoc();

if(isset($_POST['submit']))
{
      
  // ini semua buat ambil data biar bisa dimasukkan ke database
  $npm = $row['npm'];
  $semester = $row2['semester'];
  foreach($_POST['kodejadwal'] as $value){

  $query3 = mysqli_query($DBConn,"SELECT * From karturencanastudi WHERE npm = '$npm' AND kode_jadwal='$value'");
  if($query3){
    $query = mysqli_query($DBConn,"INSERT INTO karturencanastudi(npm, kode_jadwal, semester) VALUES ('$npm','$value', '$semester')");
    if($query){
      echo "<script> alert('Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_krs.php">';
   }else{
    echo "<script> alert('Koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_krs.php">';
  }
} 
}
}

?>





