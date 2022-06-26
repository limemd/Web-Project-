    
<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
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

            <div class="icons">    <!-- logare -->
            <?php
            if (isset($_SESSION['username'])) {
                ?>
                <a href="logout.php" class="logout11" id="logout_user" onclick="return confirm('Te deloghezi?');">logout </a>
                <a href="cart.php" class="fas fa-shopping-cart"></a> 
                <?php
            }
            else {
                ?>
                <a href="login.php" class="login11" id="login_user">Logare </a>
                
                <a href="cart.php" class="fas fa-shopping-cart"></a>
                <?php
            }
            ?>
            </div>
            
        </div>
    </header>

    <!--Sectiunea Home-->


    <section class="home" id="home">
        <div class="image">
            <img src="img/1.png" alt="">
        </div>
        <div class="content">
            <span>
                Natural si Calitativ
            </span>
            <h3>Torturi, prajituri si alte deserturi la comanda</h3>
        <a href="meniu.php" class="btn">Vezi Produse</a>

        </div>
    </section>
    <h2 id="workshop">Din WorkShop-ul Recent</h2>
    <!--Slideshow Reviwe de pe w3schools-->
    <section class="slide">
        <div class="box-container">
          
    <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>   
          <img class="rev" src="img/tutorial1.png" >
          <div class="text">Tutorial Prajituri</div>
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img class="rev" src="img/tutorial2.png">
          <div class="text">Tutorial Prajituri</div>
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img class="rev" src="img/tutorial3.png">
          <div class="text">Tutorial Prajituri</div>
        </div>
        
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        
        </div>
        <br>
        
        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
        </div>
        </div>
    </section>

    <!--Sectiunea Footer-->
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