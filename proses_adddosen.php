<?php
include"koneksi.php";
if(isset($_POST['submit']))
{

	// ini semua buat ambil data biar bisa dimasukkan ke database
  $kode_dosen = $_POST['kode_dosen'];
  $password_dosen = $_POST['password_dosen'];
  $status = $_POST['status'];
  $nama_dosen = $_POST['nama_dosen'];
  $prodi = $_POST['kode_prodi'];
  $tempat_lahir_dosen = $_POST['tempat_lahir_dosen'];
  $tanggal_lahir_dosen = $_POST['tanggal_lahir_dosen'];
  $agama = $_POST['agama'];
  $gender = $_POST['gender'];

 if ($kode_dosen === "") {
      echo "<script> alert('Silahkan input Kode Dosen!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($nama_dosen === "") {
      echo "<script> alert('Silahkan input Nama Dosen!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($prodi === "") {
      echo "<script> alert('Silahkan input Program Studi!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($tempat_lahir_dosen === "") {
      echo "<script> alert('Silahkan input Tempat Lahir!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($tanggal_lahir_dosen === "") {
      echo "<script> alert('Silahkan input Tanggal Lahir!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($agama === "") {
      echo "<script> alert('Silahkan input Agama!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if ($gender === "") {
      echo "<script> alert('Silahkan input Jenis Kelamin!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }if($kode_dosen && $nama_dosen && $prodi && $tempat_lahir_dosen && $tanggal_lahir_dosen && $agama && $gender) {
    $query = mysqli_query($DBConn,"INSERT INTO dosen(kode_dosen, password, nama_dosen, kode_prodi, tempat_lahir, tanggal_lahir, gender, agama, status_aktif) VALUES ('$kode_dosen','$password_dosen', '$nama_dosen','$prodi','$tempat_lahir_dosen','$tanggal_lahir_dosen','$gender','$agama','$status')");
     if($query){
       echo "<script> alert('Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_dosen.php">';
      }else{
       echo "<script> alert('Koneksi gagal!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
  }
  }else{
    echo "<script> alert('Not Succesfully Added!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=add_dosen.php">';
}

}
?>