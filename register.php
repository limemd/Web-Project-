<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	// hashuirea parolei
	// $password = md5($_POST['password']);
	$password= password_hash($_POST['password'], PASSWORD_DEFAULT);

	//
	// $sql1 = "SELECT * FROM users WHERE username='$username'";
	// $result1 = mysqli_query($conn, $sql1);
	$sql1 = $conn->prepare("SELECT * FROM users where username= ?");
	$sql1->bind_param("s",$username);
	if ($sql1->execute()) {
		$sql1->store_result();
		$rand = $sql1->num_rows;
		if($rand == 0){
			$sql1->close();
			$sql2 = $conn->prepare("INSERT INTO users(username,password) VALUES(?,?);");
			$sql2 ->bind_param("ss",$username,$password);
				if (!$sql2 ->execute()) {
					echo "<script>alert('Woops! Something Wrong Went.')</script>";
					$sql2->close();
				} else {
					echo "<script>alert('Wow! User Registration Completed.')</script>";
					$username = "";
					$_POST['password'] = "";
					$sql2->close();
					header("Location: login.php");	
				}
		}else {
				echo "<script>alert('Woops! Utilizatorul deja exista.')</script>";
				$sql1->close();
			}


		// $sql = "INSERT INTO users (username, password)
		// 			VALUES ('$username', '$password')";
		// 	$result = mysqli_query($conn, $sql);
		// $sql2 = $conn->prepare("INSERT INTO users(username,password) VALUES(?,?);");
		// $sql2 ->bind_param("ss",$username,$password);
		

		// 	if (!$sql2 ->execute()) {
		// 		echo "<script>alert('Woops! Something Wrong Went.')</script>";
		// 		$sql2->close();
		// 		echo "<script>console.log('1');</script>";
		// 	} else {
		// 		echo "<script>alert('Wow! User Registration Completed.')</script>";
		// 		$username = "";
		// 		$_POST['password'] = "";
		// 		$sql2->close();
		// 		// header("Location: login.php?error=none");
		// 		echo "<script>console.log('2');</script>";

		// 	}
		
	}else{
		echo "<script>alert('Woops! Something Wrong Went.')</script>";
		$sql1->close();
	}

	
			
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<title>Inregistrare</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
        <a href="index.php"><img src="img/logo.png" class="logo_login" alt=""></a>
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Inregistrare</p>
			<div class="input-group">
				<input type="text" placeholder="Utilizator" name="username" minlength="5" value="" required>
			</div>
			<div class="input-group">
				<input type="password" minlength="5" placeholder="Parola" name="password" value="" required>
            </div>
			<div class="input-group">
				<button name="submit" class="btn">Inregistrare</button>
			</div>
			<p class="login-register-text">Ai cont ? <a href="login.php"> Logheaza-te aici</a>.</p>
		</form>
	</div>
</body>
</html>