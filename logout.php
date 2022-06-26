<?php 
include 'config.php';
session_start();
//echo $id_user;
if (isset($_SESSION['username']))
    {
         $utilizator = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username='$utilizator'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_user= $row['id_user'];
        }
}
//echo $id_user;
unset($id_user);
session_destroy();

header("Location: index.php");

// imi vede id-ul utilizatorului


?>