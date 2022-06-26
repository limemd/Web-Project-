<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
	if($_SESSION['username']=='admin')
	{
		header("Location: admin.php");
	}
	else
	{
		header("Location: index.php");
	}
   
}

if (isset($_POST['submit'])) {

	$username = trim($_POST['username']);
	$form_password = trim($_POST['password']);

	$sql1 =$conn->prepare("SELECT * from users where username= ?");
	$sql1->bind_param("s",$username);
	$sql1->execute();
	$rezultat=$sql1->get_result();


	if ($rezultat->num_rows > 0) {
		while($row =$rezultat->fetch_assoc() )
		{
				// $row = mysqli_fetch_assoc($sql1);
		$parola_bd = $row['password'];
		

		if(password_verify($form_password, $parola_bd))
		{
			$_SESSION['username'] = $row['username'];
			$_SESSION['id_user']=$row['id_user'];
			if($_SESSION['username']=='admin')
			{
				header("Location: admin_produse.php");
			}
			else
			{
				header("Location: index.php");
			}
			
		}
		else
		{
			echo "<script>alert('Woops! username or Password is Wrong.')</script>";
		}
		}
		
	}
	else
	{
		header("Location: login.php");
	}
};

?>







<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Forma Logare</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<a href="index.php"><img src="img/logo.png" class="logo_login" alt=""></a>
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Logare</p>
			<div class="input-group">
				<input type="text" placeholder="Utlizator" name="username" value="">
			</div>
			<div class="input-group">
				<input type="password" placeholder="Parola" name="password"  required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Logare</button>
			</div>
			<p class="login-register-text">Nu ai cont ?<a href="register.php"> Inregistreaza-te aici</a>.</p>
		</form>
	</div>
</body>
</html>