<?php 
session_start();

if((isset($_SESSION['a_name'])) && (!empty($_SESSION['a_name']))){
	header("Location: pages/index.php");
	exit();
}else{
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login Admin Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="assets/image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
	<script src="./assets/js/jquery-3.3.1.js"></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image:url('images/udanwing2.jpg'); background-repeat: no-repeat; background-position: center; background-size: 100% 100%">
			<div class="wrap-login100" style="background-color:rgba(255,255,255,0.93);">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/mva.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="loginsubmit.php" method="post">
					<img src="images/logintype.png" style="width:18em;">
					<br>
					<br>
					<br>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="username" id="email" placeholder="Email" style="color:black;" required autofocus="true">
						<span class="focus-input100" style="color:#045D97;"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" id="sym1" aria-hidden="true" style="color:grey;"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password" required="">
						<span class="focus-input100" style="color:#045D97"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true" style="color:grey;"></i>
						</span>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color:#045D97;background-image: url('images/Rectangle.png');background-position: center;background-size: 100% 100%">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">

					</div>

					<div class="text-center p-t-110">
						<!-- <a class="txt2" href="signup.php"> -->
							<!-- Create your Account -->
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						<!-- </a> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$("#email").focus(function(){
			$('#sym1').css("color", "rgb(55,114,161)");
		});
		$("#email").blur(function(){
			$('#sym1').css("color", "grey");
		});

		$("#password").focus(function(){
			$('#sym1').css("color", "rgb(55,114,161)");
		});
		$("#password").blur(function(){
			$('#sym1').css("color", "grey");
		});
	</script>

	
<!--===============================================================================================-->	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

</body>
</html>