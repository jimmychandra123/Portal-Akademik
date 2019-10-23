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
  <?php 

          if(isset($_GET['id'])){

          $id=$_GET['id'];
        

  $sql1 = "SELECT * FROM mahasiswa WHERE npm = '$id'";
  $result1 = $DBConn->query($sql1);
  $row1 = $result1->fetch_assoc();
          }
          ?>

  <div class="tabel">
  <a href="manage_mahasiswa.php">Kembali</a>
  </div>
      <h2>Form Edit Data Mahasiswa </h2>

          <form method="post" >
         <table class="tabel"> 
         <tbody>
          <tr width="150">
            <th>NPM :</th>
          <td><input type="text" name="npm" value="<?php echo $row1['npm'] ?>" size="70" disabled></td>
          </tr>

          <tr>
          <th>Nama Mahasiswa :</th>
          <td><input name="nama_mahasiswa" autocomplete="off"  value="<?php echo $row1['nama'] ?> "type="text" size ="70"></td>
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
       <th>Semester :</th>
       
            <td><select style="width:450px" name="semester">
            
            <option value="" selected>~~~ Silahkan Pilih Program Studi ~~~</option>
            <?php
            $ssql = "SELECT * FROM `semester`";
            $sresult = $DBConn->query($ssql);
            while ($srow = $sresult->fetch_assoc()) {
            ?>
                        
                  <option value="<?php echo $srow['kode_semester'] ?>" ><?php echo $srow['semester'] ?></option>
             <?php
          }
          ?>               

          </select></td>
          </tr>

          <tr>
          <th>Status Mahasiswa :</th>
       
            <td><select style="width:450px" name="status">
            <option value="" selected="">~~~ Silahkan Pilih Status ~~~</option>
            
              <option value="Aktif" >Aktif</option>
              <option value="TidakAktif">Tidak Aktif</option>

          </select></td>
          </tr>
          

          <!-- <input name="password_dosen" autocomplete="off" type="text" value="<?php echo $row1['password'] ?>" size ="50"> -->
          <tr>
          <th>Tempat Lahir Mahasiswa :</th>
          <td><input name="tempat_lahir_mahasiswa" autocomplete="off" type="text" size ="70" value="<?php echo $row1['tempat_lahir'] ?>" placeholder="Batam-Kepri,Indonesia"></input></td>
          </tr> 

          <tr>
          <th>Tanggal Lahir Mahasiswa :</th>
          <td><input name="tanggal_lahir_mahasiswa" autocomplete="off" type="date" size ="70" value="<?php echo $row1['tanggal_lahir'] ?>"></input></td>
          </tr>

          <tr>
          <th>Agama :</th>
            
            <td><select style="width:450px" name="agama">
            <option value="" selected>~~~ Silahkan Pilih Agama ~~~</option>
              <option value="Buddha">Buddha</option>
              <option value="Hindu">Hindu</option>
              <option value="Islam">Islam</option>
              <option value="Katolik">Katolik</option>
              <option value="Kristen">Kristen</option>
          </select></td>
          </tr>
          
          <tr>
          <th>No hp :</th>
          <td><input name="no_hp" value="<?php echo $row1['no_hp'] ?> "type="text" size ="70" </td>
          </tr>

          <th>Alamat :</th>
          <td><input name="alamat" value="<?php echo $row1['alamat'] ?> "type="text" size ="70" </td>
          </tr>
          <tr>

            <th>Jenis Kelamin :</th>
          <td><input name="jenis_kelamin" value="<?php echo $row1['gender'] ?> "type="text" size ="70" disabled</td>
          </tr>
          <tr>

      <tr>
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
   
    $status = $_POST['status'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $prodi = $_POST['kode_prodi'];
    $tempat_lahir_mahasiswa = $_POST['tempat_lahir_mahasiswa'];
    $tanggal_lahir_mahasiswa = $_POST['tanggal_lahir_mahasiswa'];
    $agama = $_POST['agama'];
    $gender = $_POST['gender'];
    $semester = $_POST['semester'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $npm = $_POST['npm'];

 
  if ($nama_mahasiswa === "") {
      echo "<script> alert('Silahkan input Nama Mahasiswa!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($prodi === "") {
      echo "<script> alert('Silahkan input Program Studi!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($semester === "") {
      echo "<script> alert('Silahkan input Semester!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($status === "") {
      echo "<script> alert('Silahkan input Status Mahasiswa!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($tempat_lahir_mahasiswa === "") {
      echo "<script> alert('Silahkan input Tempat Lahir!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($tanggal_lahir_mahasiswa === "") {
      echo "<script> alert('Silahkan input Tanggal Lahir!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($agama === "") {
      echo "<script> alert('Silahkan input Agama!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($no_hp === "") {
      echo "<script> alert('Silahkan input No HP!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if ($alamat === "") {
      echo "<script> alert('Silahkan input Alamat!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=edit_mahasiswa.php">';
  }if($nama_mahasiswa && $prodi && $semester && $no_hp && $tempat_lahir_mahasiswa && $tanggal_lahir_mahasiswa && $agama && $alamat) {

  $query = mysqli_query($DBConn,"UPDATE mahasiswa SET nama='$nama_mahasiswa', kode_prodi='$prodi', tempat_lahir='$tempat_lahir_mahasiswa', tanggal_lahir='$tanggal_lahir_mahasiswa', agama='$agama',status_aktif='$status', alamat ='$alamat', no_hp='$no_hp', kode_semester='$semester' WHERE npm='$id'");  
    if ($query) {
       echo "<script> alert('Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_mahasiswa.php">';
  }else{
      echo "<script> alert('koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_mahasiswa.php">';
  } 
}else{
      echo "<script> alert('Not Succesfully Edited!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_mahasiswa.php">';
  } 
}
?>
