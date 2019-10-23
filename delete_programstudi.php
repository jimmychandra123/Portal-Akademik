<?php 


 $servername   = "localhost";
 $username   = "root";
 $password   = "";
 $databasename = "db_akademik";

 $DBConn   = mysqli_connect($servername,$username,$password,$databasename);

if (isset($_GET['id'])) {

  $id=$_GET['id'];

  $query=mysqli_query($DBConn,"DELETE FROM programstudi WHERE kode_prodi='$id'");

  if ($query) {
    echo "<script> alert('Succesfully Deleted!');</script>";
    echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
  }else{
	echo "<script> alert('Not Succesfully Deleted!');</script>";
    echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=manage_programstudi.php">';
  }  	
}
 ?>
