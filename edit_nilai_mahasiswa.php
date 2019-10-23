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
<?php include'menu-dosen.php' ?>
</div>

<div class="konten">
  <h2>Input Nilai Mahasiswa</h2>
   <div class="isikonten">
      <p>Keterangan : </br>
         Input Nilai Mahasiswa, Fitur ini dapat digunakan oleh dosen untuk meng-Input Nilai Mahasiswa di Universitas JimmyChandra.</p>
   </div>

  <div class="isikonten">
  <?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
        


 $sql1 = "SELECT kelas.*, matakuliah.*, semester.*, jadwal.*, ruangkelas.*, dosen.*, karturencanastudi.*, mahasiswa.* FROM karturencanastudi INNER JOIN jadwal ON karturencanastudi.kode_jadwal = jadwal.kode_jadwal INNER JOIN semester ON jadwal.kode_semester = semester.kode_semester INNER JOIN matakuliah ON jadwal.kode_matkul = matakuliah.kode_matkul INNER JOIN dosen ON jadwal.kode_dosen = dosen.kode_dosen INNER JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas INNER JOIN ruangkelas ON jadwal.kode_ruang = ruangkelas.kode_ruang INNER JOIN mahasiswa ON karturencanastudi.npm = mahasiswa.npm WHERE dosen.kode_dosen='$kde_dsen' AND karturencanastudi.kode_krs = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>

  <div class="tabel">
  <a href="nilai_mahasiswa.php">Kembali</a>
  </div>
      <h2>Form Edit Nilai Mahasiswa</h2>

          <form method="post" >
         <table class="tabel"> 
         <tbody>
          <tr width="150">
            <th>NPM :</th>
          <td><input type="text" name="" value="<?php echo $row1['npm'] ?>" size="70" disabled></td>
          </tr>
          <tr width="150">
            <th>Nama Mahasiswa :</th>
          <td><input type="text" name="" value="<?php echo $row1['nama'] ?>" size="70" disabled></td>
          </tr>
          <tr width="150">
            <th>Kelas :</th>
          <td><input type="text" name="" value="<?php echo $row1['nama_kelas'] ?>" size="70" disabled></td>
          </tr>
          <tr width="150">
            <th>Matakuliah :</th>
          <td><input type="text" name="" value="<?php echo $row1['nama_matkul'] ?>" size="70" disabled></td>
          </tr>

          <tr>
            <th>Nilai Mahasiswa :</th>
       
            <td><select style="width:450px" name="nilai_mahasiswa">
              <option value="" selected="">~~~ Silahkan Pilih Grade Nilai ~~~</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
          </select></td>
          </tr>
                    <th colspan="2"><input type="submit" name="submit" value="Update">
          </th>
        </tr>
        </tbody>
          </table>
          </form>
    </div>
  </div>






<div class="footer">
  <h2>Portal Akademik UNIVERSITAS JIMMY CHANDRA</BR>  
© 2019 - 2030. All Right Reserved</h2>
</div>


</div>





</body>
</html>


<?php 
  include"koneksi.php";

  if (isset($_POST['submit'])) {
    $nilai = $_POST['nilai_mahasiswa'];
    $krs = $id;

  if ($nilai === "") {
  echo "<script> alert('Silahkan input Nilai!');</script>";
  echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=nilai_mahasiswa.php">';
  }if($nilai) 
  {
  
  $sql2 = "UPDATE karturencanastudi SET nilai='$nilai' WHERE  kode_krs='$krs'";
  $query2 = $DBConn->query($sql2);
  
    if ($query2) {
       echo "<script> alert('Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=nilai_mahasiswa.php">';
  }else {
       echo "<script> alert('Koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=nilai_mahasiswa.php">';
  }

}else {
       echo "<script> alert('Not Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=nilai_mahasiswa.php">';
  }
}
?>
