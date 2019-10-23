<?php 
include'koneksi.php';
session_start();
if(!isset($_SESSION["MahasiswaID"]))
  {
    header("Location: index.php");
  };
 $sql = "SELECT * FROM mahasiswa WHERE npm = '".$_SESSION['MahasiswaID']."'";
  $result = $DBConn->query($sql);
  $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html>

<head>
<title>Portal Akademik UNIVERSITAS JIMMY CHANDRA</title>
<link rel="stylesheet" href="css/bootstrap.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
	<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<img src="logojc.png" width="400px" height="100px">
			</div>

			<div class="card-body">
				<form action="#" method="post">
					<div class="input-group form-group">
						
						<p>NPM :&ensp;&ensp;&ensp;</p><input type="text" class="form-control" name="npm" value="<?php echo $row['npm'];?>">
						
					</div>
					
				
						<div class="input-group form-group">
					<p>Password Baru :  &ensp;&ensp;&ensp;</p>	<input type="password" class="form-control" name="passwordbaru" placeholder="Input password baru anda...">
						
					</div>
					
				<!-- 	<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
				 -->	<div class="form-group">
				 		<center><input type="submit" name="submit" value="Change Password" class="btn float-mid login_btn"></center>
						
					</div>
				</form>
			</div>
			<div class="card-footer">
				<!-- <div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div> -->
				<div class="d-flex justify-content-center">
					<a >Universitas JIMMY CHANDRA©</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php

  if(isset($_POST['submit'])) {
  $passwordbaru = $_POST['passwordbaru'];
if ($passwordbaru === "") {
  			echo "<script> alert('Silahkan Input Password Baru Anda!'); window.location.href='halaman_changepassmahasiswa.php' </script>";;
  		}if($passwordbaru){
		
				$qryEdit = "UPDATE mahasiswa SET password = '$passwordbaru' WHERE npm= ?";
			    $stmtUpdUser = $DBConn->prepare($qryEdit);
			    $stmtUpdUser->bind_param("s",$_SESSION['MahasiswaID']);
			    $stmtUpdUser->execute();
			    if($qryEdit){
			     echo "<script> alert('Berhasil Ganti Password! Silahkan Login untuk Melanjutkan!'); window.location.href='index.php' </script>";
			 	}			 
				}
				}
			
				?>