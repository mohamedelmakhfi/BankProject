<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bank</title>
	<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<style>
		body {
			background: url("images/bankbackground.jpg");
			background-size: cover;
			margin: 0;
			font-family: Arial, sans-serif;
		}

		#container {
			max-width: 500px;
			margin: 0 auto;
			background: rgba(255, 255, 255, 0.8);
			border-radius: 10px;
			padding: 20px;
			margin-top: 50px;
		}

		h1 {
			text-align: center;
			color: #28a745;
		}

		.login-form {
			margin-top: 20px;
		}

		.form-control {
			margin-bottom: 15px;
		}

		.titre {
			color: #0056b3;
		}

		.btnn-login {
			width: 100%;
			background-color: #007bff;
			/* Blue color */
			color: #fff;
			border: 1px solid #0056b3;
			/* Darker shade of blue for border */
			border-radius: 5px;
			padding: 10px 15px;
			cursor: pointer;
			transition: background-color 0.3s ease, color 0.3s ease;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			margin: 0 auto;
		}

		.btnn-login:hover {
			background-color: #0056b3;
			/* Darker shade of blue on hover */
			color: #fff;
		}

		/* Optional: Add focus styles for better accessibility */
		.btnn-login:focus {
			outline: none;
			box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.3);
			/* Lighter shade of blue for focus */
		}

		.titre2 {
			color: #007bff;
			/* Blue color */
			font-size: 24px;
			/* Set your desired font size */
		}


		hr {
			border: none;
			height: 2px;
			background-color: #007bff;
			/* Blue color */
			width: 50%;
			/* Set your desired width */
			margin: 20px auto;
			/* Center the line horizontally and add some margin */
		}
	</style>
	<?php
	$con = new mysqli('localhost', 'root', '', 'mybank');
	define('bankname', 'MCB Bank');

	$error = "";
	if (isset($_POST['userLogin'])) {
		$error = "";
		$user = $_POST['email'];
		$pass = $_POST['password'];

		$result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
		if ($result->num_rows > 0) {
			session_start();
			$data = $result->fetch_assoc();
			$_SESSION['userId'] = $data['id'];
			$_SESSION['user'] = $data;
			header('location:index.php');
		} else {
			$error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		}
	}
	
	if (isset($_POST['managerLogin'])) {
		$error = "";
		$user = $_POST['email'];
		$pass = $_POST['password'];

		$result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
		if ($result->num_rows > 0) {
			session_start();
			$data = $result->fetch_assoc();
			$_SESSION['managerId'] = $data['id'];
			//$_SESSION['user'] = $data;
			header('location:mindex.php');
		} else {
			$error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		}
	}
	?>
</head>

<body>
	<div id="container">
	<br>
		<h1 class="titre">Banking</h1>
		<hr>
		<br>
		<?php echo $error; ?>

		<!-- User Login Form -->
		<div class="login-form">
			<h4 class="text-center titre2">User Login</h4>
			<form method="POST">
				<input type="email" name="email" class="form-control" required placeholder="Enter Email">
				<input type="password" name="password" class="form-control" required placeholder="Enter Password">
				<button type="submit" class="btnn-login" name="userLogin">Login user</button>
			</form>
		</div>
	<br>
	<br>
		<hr>
		<br>
		<!-- Manager Login Form -->
		<div class="login-form">
			<h4 class="text-center titre2">Admin Login</h4>
			<form method="POST">
				<input type="email" name="email" class="form-control" required placeholder="Enter Email">
				<input type="password" name="password" class="form-control" required placeholder="Enter Password">
				<button type="submit" class="btnn-login" name="managerLogin">Login Admin</button>
			</form>
		</div>
		<br>
		<br> 
	</div>
</body>

</html>