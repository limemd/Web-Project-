<?php
session_start();
include 'config.php';
if (isset($_SESSION['username']))
{
    $id_user = $_SESSION['id_user'];
}

// echo $id_user;
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
<html>

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

    <section class="wrapper">
        <div class="row">
            <div class="image-section">
                <img src="img/veronica.jpg" alt="">
            </div>
            <div class="content">
                <h1>Despre Noi</h1>
                <h2>Patiseria Noastra</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere deleniti magni distinctio quia laboriosam, quos ab accusantium voluptatibus et, minus asperiores! Repellendus exercitationem iure fuga, velit voluptate id quaerat minus.</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas tenetur sed voluptas id, saepe facilis, aperiam dolores magni debitis incidunt reiciendis, distinctio quidem facere doloribus eum velit maiores qui perspiciatis!</p>
            </div>
        </div>
    </section>


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