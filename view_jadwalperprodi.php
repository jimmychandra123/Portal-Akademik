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
  <h2>Manage Data Jadwal Kelas</h2>
  <div class="isikonten">
    <p>Keterangan : </br>
      Manage Data Jadwal Kelas, Fitur ini hanya dapat digunakan oleh admin untuk menambah dan mengedit data Jadwal Kelas yang terdaftar di Universitas JimmyChandra.</p></div>
  
  
  <div class="isikonten">
<?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
          $sql1 = "SELECT * FROM programstudi WHERE kode_prodi = '$id'";
          $result1 = $DBConn->query($sql1);
          $row1 = $result1->fetch_assoc();
          }
          ?>


  <div class="tabel" >
  <a href="manage_jadwal.php">Kembali</a> || <a href="add_jadwal.php?id=<?php echo $id ?>">Tambah Jadwal</a> 
    </div>
              <table class="tabel">
    
        <tr >
          <td>Kode Jadwal</td>
          <td>Nama Kelas</td>
          <td>Matakuliah</td>
          <td>Nama Dosen</td>
          <td>Hari & Jam Kelas</td>


          <td>Action</td> 
        </tr>
     
    <h2>Form List Jadwal Prodi <?php echo $row1['nama_prodi'];?> </h2>
    <?php 
        $dsql = "SELECT kelas.*, matakuliah.*, programstudi.*, semester.*, jadwal.*, ruangkelas.*, dosen.* FROM jadwal INNER JOIN programstudi ON jadwal.kode_prodi = programstudi.kode_prodi INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang WHERE jadwal.kode_prodi = '$id' ORDER BY jadwal.kode_jadwal ASC";
      $result = $DBConn->query($dsql);
      
      if ($result->num_rows > 0) 
      {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
      ?>
        <tr >
          <td><?php echo $row['kode_jadwal'] ?></td>
          <td><?php echo $row['nama_kelas'] ?></td>
          <td><?php echo $row['nama_matkul'] ?></td>
          <td><?php echo $row['nama_dosen'] ?></td>
          


        
          <td><?php echo $row['hari'] ?>, <?php echo $row['jam_mulai'] ?> - <?php echo $row['jam_selesai'] ?> (<?php echo $row['nama_ruang'] ?>)</td>

          <td><a href="edit_jadwal.php?id=<?php echo $row['kode_jadwal'] ?>">Edit</a> || <a href="delete_jadwal.php?id=<?php echo $row['kode_jadwal'] ?>">Delete</a></td>

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
