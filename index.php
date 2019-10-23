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
				<form action="proses-login.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="password">
					</div>
				<!-- 	<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
				 -->	<div class="form-group">
				 		<center><input type="submit" name="login" value="Login" class="btn float-mid login_btn"></center>
						
					</div>
				</form>
			</div>
			<div class="card-footer">
				<!-- <div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div> -->
				<div class="d-flex justify-content-center">
					<a href="aboutME.php">Jimmy Chandra - 1731075</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>


