<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
else{
    header("Location: index.html");
    echo"<script language='javascript'>
    let login11 = document.querySelector('#login_user');
    let logout11 = document.querySelector('#logout_user');

    login11.classList.remove('login11');
    login11.classList.add('dispare');

    logout11.classList.remove('logout11');
    logout11.classList.add('apare');

    </script> 
    ";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>

    <!-- <a href="index.html"></a>
    <a href="logout.php">Logout</a> -->
    <!--echo "<h1>Welcome " . $_SESSION['username'] . "</h1>";  -->
</body>
</html>