<?php
include 'config.php';
session_start();

// WHERE username="'$utilizator'"



$message_sent = false;


if(isset($_POST['submit']))
{


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
    else {
        $id_user = NULL;
        //imi ia id-ul la utilizatorul logat..de exe petru  =8 

    }



    $name = $_POST['name'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $subiect =$_POST['subiect'];
    $textarea =$_POST['textarea'];

    
    $message_sent = true;

    // mail($to,$subiect,$body);
    // print_r($_POST);

    $query1 = "INSERT INTO contact (id_user,nume,email,telefon,subiect,textarea)
    VALUES ('$id_user', '$name', '$email', '$telefon', '$subiect', '$textarea');";

    $result1=mysqli_query($conn, $query1);

    if (!$result1) {
        echo mysqli_error($conn);
    } else {
        echo "";
    }
 
}
else
{
    $message_sent = false;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partial</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>


    <!--Sectiunea Header-->
    <header>
        <div class="header-1">
            <img src="img/logo.png" id="logo1" alt="">
            <a href="index.php" class="logo">  Dulci Inspiratii</a>
            <!-- login register -->
            
        </div>


        <div class="header-2">
            <!--Sectiunea cu meniu hidden-->
            <div id="menu-bar" class="fas fa-bars">

            </div>

            <nav class="navbar">
                <a href="index.php">Acasa</a>
                <a href="meniu.php">Meniu</a>
                <a href="contact.php">Contact</a>
                <a href="despre.php">Despre</a>
            </nav>

            <form action="search.php" class="search-box-container" method="POST">
                <input required type="search" id="search-box" name="caut" placeholder="Cauta aici...">
                
                <button type="submit" class="fas fa-search" id="asp" name="submit"></button>
            </form>
                <!-- Seacrh bar -->

                <!-- logare -->
            
                <div class="icons">    <!-- logare -->
            <?php
            if (isset($_SESSION['username'])) {
                ?>
                <a href="logout.php" class="logout11" id="logout_user" onclick="return confirm('Te deloghezi?');">logout </a>
                <a href="cart.php" class="fas fa-shopping-cart"></a> ';
                <?php
            }
            else {
                ?>
                <a href="login.php" class="login11" id="login_user">Logare </a>
                
                <a href="cart.php" class="fas fa-shopping-cart"></a>';
                <?php
            }
            ?>
            </div>
            
        </div>
    </header>
    <!--Sectiunea Contact-->
    <section class="contact">
        <?php
    if($message_sent):
    ?>
        <h1 class="heading">
            Va multumim pentru mesaj!
        </h1>
<?php
else:
?>
        <h1 class="heading">
            Contacteaza-ne
        </h1>
<?php endif;?>
        <!-- forma -->
        <form action="contact.php" method="post">
            <div class="inputBox">
                <input type="text" placeholder="nume prenume" name="name" required>
                <input type="email" placeholder="email" name="email" required>

            </div>

            <div class="inputBox">
                <input type="tel" 
                minlength="9" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                 placeholder="telefon" name="telefon"  maxlength="10" required>
                <input type="text" placeholder="subiect" name="subiect" required>
            </div>

            <textarea placeholder="mesaj" name="textarea" id="" cols="30" rows="10" required>

            </textarea>
            <input type="submit" name="submit" value="Trimite Mesaj" class="btn" >
        </form>

    </section>
    <section class="map">
        <div class="box-container">
            <h1>Unde ne puteti gasi</h1>
            <div class="box">
                     
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1388.1890527887329!2d28.184853275424288!3d45.90374974420396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b65d2d2ddef1df%3A0x1a62895dbe61c572!2sEpiscopia%20Basarabiei%20de%20Sud!5e0!3m2!1sen!2sro!4v1651684855076!5m2!1sen!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
        </div>
        
    </section>

    <!--Sectiunea FOoter-->
    <section class="footer">
        <div class="box-container">

            <div class="box">
                <img src="img/logo.png" id="logo" alt="">
                <h1 class="copy">©Dulci Inspiratii 2022</h1>
                <a href="https://www.facebook.com/dulcinspiratii" target="blank" class="btn fab fa-facebook-f"></a>
                    <a href="#" class="btn fab fa-instagram"></a> 
            </div>
            

        </div>
        
        
    </section>

    <script src="js/main.js"></script>
</body>
</html>