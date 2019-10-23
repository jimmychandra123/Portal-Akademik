<?php
session_start();
require "koneksi.php";

$Student_ID         = $_POST['username'];
$Student_Password   = $_POST['password'];

    $select = "select * from mahasiswa where npm = '$Student_ID' and BINARY password='$Student_Password'";
    $run    = $DBConn->query($select); 
    $row    = mysqli_fetch_assoc($run);

    $select1 = "select * from dosen where kode_dosen = '$Student_ID' and BINARY password='$Student_Password'";
    $run1    = $DBConn->query($select1);
    $row1    = mysqli_fetch_assoc($run1);

    $select2 = "select * from admin where kode_admin = '$Student_ID' and BINARY password='$Student_Password'";
    $run2    = $DBConn->query($select2);
    $row2    = mysqli_fetch_assoc($run2);
  
  if($row > 0)
  {
    $name = $row['nama'];
    $pass = $row['password'];
    $status = $row['status_aktif'];
    $_SESSION['MahasiswaID'] = $Student_ID;
   if ($status === 'Aktif') {
      if($pass != '123456')
    {
      echo "<script> alert('Succesfully login! Welcome $name');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=halaman_mahasiswa.php">';
      }else{
      echo "<script> alert('Succesfully login! Now Change your Password $name!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=halaman_changepassmahasiswa.php">';
      }
}else{
       echo "<script> alert('Maaf akun $name telah di Non-Aktifkan!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
  }


}elseif($row1 > 0)
  {
    $name = $row1['nama_dosen'];
    $pass = $row1['password'];
    $status = $row1['status_aktif'];
    $_SESSION['DosenID'] = $Student_ID;
    if($status === 'Aktif'){
    if($pass != '123456' )
    {
      echo "<script> alert('Succesfully login! Welcome $name');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=halaman_dosen.php">';
    }else{
      echo "<script> alert('Succesfully login! Now Change your Password $name!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=halaman_changepassdosen.php">';
      }
}else{
       echo "<script> alert('Maaf akun $name telah di Non-Aktifkan!');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
  }  

  }elseif($row2 > 0)
  {
    $name = $row2['nama_admin'];
    $pass = $row2['password'];
    $_SESSION['AdminID'] = $Student_ID;
    if($pass == $Student_Password)
    {
      echo "<script> alert('Succesfully login! Welcome $name');</script>";
      echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=halaman_admin.php">';
    }
}else
{
    echo "<script> alert('Failed login! Cek kembali username dan password anda!!!');</script>";
    echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
}
 
  
  $DBConn->close();
?>