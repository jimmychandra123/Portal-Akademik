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
  $kde_dsen = $_SESSION['DosenID'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Portal Akademik UNIVERSITAS JIMMY CHANDRA</title>

  <link rel="stylesheet" type="text/css" href="css/tampilanmenuutama.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/collapse.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


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
    <h1><?php echo $row['nama_dosen']; ?></h1>
    <h1><?php echo $row['kode_dosen']; ?></h1>
    <h1><?php echo $row['nama_prodi']; ?></h1>
    <a href="index.php">Logout</a>
  </div>
<?php
include'menu-dosen.php';
?>
</div>

<div class="konten">
  <h2>Input Nilai Mahasiswa</h2>
 	 <div class="isikonten">
    	<p>Keterangan : </br>
      	 Input Nilai Mahasiswa, Fitur ini dapat digunakan oleh dosen untuk meng-Input Nilai Mahasiswa di Universitas JimmyChandra.</p>
 	 </div>
  
  
  <div class="isikonten">
    <table class="tabel">
    
        <tr >
         <td>No</td>
          <td>NPM</td>
          <td>Kelas</td>
          <td>Nama Matakuliah</td>
          <td>Semester</td>
          <td>Nilai</td>
          <td>Action</td>


         
        </tr>
     
    <h2>Form List Nilai Mahasiswa</h2>
    <?php 
        $dsql = "SELECT kelas.*, matakuliah.*, programstudi.*, semester.*, jadwal.*, ruangkelas.*, dosen.*, karturencanastudi.* FROM jadwal INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang INNER JOIN karturencanastudi ON jadwal.kode_jadwal = karturencanastudi.kode_jadwal WHERE dosen.kode_dosen='$kde_dsen'  ORDER BY karturencanastudi.npm ASC ";
      $result = $DBConn->query($dsql);
      
      if ($result->num_rows > 0) 
      {
        $i = 1;
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
      ?>
        <tr >

          <td><?php echo $i; ?></td>
          <td><?php echo $row['npm'] ?></td>
          <td><?php echo $row['nama_kelas'] ?></td>
          <td><?php echo $row['nama_matkul'] ?></td>
         	<td><?php echo $row['semester'] ?></td>
		      <td><?php echo $row['nilai'] ?></td>
          <td><a href="edit_nilai_mahasiswa.php?id=<?php echo $row['kode_krs'] ?>">Edit</a></td>
        

        </tr>
        <?php
        $i++;
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






</div>





</body>
</html>

	