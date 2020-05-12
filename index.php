<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			<span class="login100-form-title p-b-26">
						Sign In
					</span>
			<?php
			include_once 'connection/connection.php';
			session_start();

			if($_SESSION['login'] == 'true'){
				header('location:home.php');
				exit();
			}
			if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'])){
				$email = $_POST['email'];
				$password = $_POST['pass'];

				if(empty($email) || empty($password)){
					echo "<span style='font-weight:bold;color:red;font-size:16px;'>Field must not be empty.</span>";
				}else{
					$password = md5($password);

					$query = "SELECT * FROM tbl_user WHERE username='$email' AND password = '$password' AND status='0'";
					$notLogin = $conn->query($query);
					$que = "SELECT * FROM tbl_user WHERE username='$email' AND password = '$password' AND status='1'";
					$alreadyLogin = $conn->query($que);
					if ($notLogin->num_rows > 0) {
					
							while($row = $notLogin->fetch_assoc()) {
								$userEmail = $row['username'];
								$userStatus = $row['status'];
							  }
							  $_SESSION['login'] = 'true';
							  $_SESSION['userEmail'] = $userEmail;
							  $_SESSION['userStatus'] = $userStatus;
							  $sql = "UPDATE tbl_user SET status='1' WHERE username='$email' AND password='$password'";
							  $resu = $conn->query($sql);
							  header('location:home.php');
							  eixt();

					  }elseif($alreadyLogin->num_rows > 0 ){
						echo "<span style='font-weight:bold;color:red;font-size:16px;'>User already loged in to another device.";
					  } else {
						echo "<span style='font-weight:bold;color:red;font-size:16px;'>Email and password does not match.</span>";
					  }
				}
			}
			?>
			<span class="login100-form-title p-b-26">
					
					</span>
				<form class="login100-form validate-form" method="POST" action="#">
					
					<!-- <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span> -->

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>