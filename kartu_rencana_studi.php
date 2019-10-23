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
  <h2>Kartu Rencana Studi</br></h2>

  <div class="isikonten">
  <p>Keterangan : </br>
Kartu Rencana Studi merupakan fasilitas pengisian KRS secara online. Fasilitas KRS Online ini hanya dapat digunakan pada saat masa KRS atau masa revisi KRS. Mahasiswa dapat memilih matakuliah yang ingin diambil bersesuaian dengan jatah sks yang dimiliki dan matakuliah yang ditawarkan. Setelah melakukan pengisian KRS mahasiswa dapat mencetak KRS tersebut agar dapat ditandatangani oleh dosen pembimbingnya masing-masing.</p> <br>
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
            
   </tbody></table>
   <br>
    <table class="tabel">
      <H2>Mata Kuliah yang diambil Saat Ini</H2>
         <tbody>
      <tr>
            <th width='20'>No</th>
            <th>Kelas</th>
            <th width ='200'>Mata Kuliah</th>
            <th>Jadwal</th>
            <th width ='70'>SKS</th>
    </tr>
<?php
$sem = $row['semester'];
  $psql = "SELECT karturencanastudi.*, matakuliah.* , semester.*, programstudi.*, jadwal.*, jadwal.*, ruangkelas.*, kelas.* FROM karturencanastudi INNER JOIN jadwal ON karturencanastudi.kode_jadwal = jadwal.kode_jadwal INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas WHERE karturencanastudi.semester='$sem' AND karturencanastudi.npm='" . $_SESSION['MahasiswaID'] . "'";
    $result = $DBConn->query($psql);
    $i = 1;
    if ($result->num_rows > 0) 
    {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
    ?>

            <tr>
                <td align="center"><?php echo $i;?></td>
                <td><?php echo $row['nama_kelas'];?></td>
                <td><?php echo $row['nama_matkul'];?></td>
                <td><?php echo $row['hari'];?>, <?php echo $row['jam_mulai'];?> - <?php echo $row['jam_selesai'];?> ( <?php echo $row['nama_ruang'];?> )</td>
                <td align="center"><?php echo $row['jumlah_sks'];?></td>
            </tr>
  <?php
  $i++;
  }
  }
                $sumsql = "SELECT SUM(matakuliah.jumlah_sks)AS totalsks FROM karturencanastudi INNER JOIN jadwal on karturencanastudi.kode_jadwal = jadwal.kode_jadwal INNER JOIN matakuliah on jadwal.kode_matkul = matakuliah.kode_matkul WHERE karturencanastudi.semester='$sem' AND karturencanastudi.npm='" . $_SESSION['MahasiswaID'] . "'";
                 $resultsum = $DBConn->query($sumsql);
                 $rowsum = $resultsum->fetch_assoc();
       
?>
            
                  
            <tr>
                <td colspan="4" align="right"><b>Total SKS diambil&nbsp;&nbsp;&nbsp;</b></td>
                <td align="center"><b><?php echo $rowsum['totalsks'];?></b></td>

            </tr>
        </tbody>

    </table>
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