<?php
include 'config.php';
session_start();

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
               

            <div class="icons">    <!-- logare -->
            <?php
            if (isset($_SESSION['username'])) {
                echo '<a href="logout.php" class="logout11" id="logout_user">logout </a>
                <a href="cart.php" class="fas fa-shopping-cart"></a> ';
            }
            else {
                echo '<a href="login.php" class="login11" id="login_user">Logare </a>
                
                <a href="cart.php" class="fas fa-shopping-cart"></a>';
            }
            ?>
            </div>
            
        </div>
    </header>

            <section class="product">
               
           
            <div class="box-container" id="boxcontainer">

            <?php
                // var_dump($_POST);
                if (isset($_POST['submit'])) {

                    $termen_cautare = $_POST['caut'];
                    $query = "SELECT * FROM produse WHERE denumire LIKE '%" . $termen_cautare . "%'" ;
                    $rezultat = mysqli_query($conn, $query) or die ('Eroare');
                    $nr_rezultate = mysqli_num_rows($rezultat);

                    if ($nr_rezultate == 0) {
                        echo "<h2>Căutarea nu a produs rezultate.</h2>";
                    } 
                    else{
                        ?>
                         <!-- <div class="numar">
                <h1><strong>Am găsit <?php echo $nr_rezultate;?> rezultate</strong></h1><br>
                </div> -->
                        <?php
                      
                        while( $row = mysqli_fetch_assoc($rezultat)){
                            echo '
                            
                                <form method="post" action="cart.php?id_produs='.$row['id_produs'].'" class="box" >
                            
                                <img src="'.$row['imagine'].'" alt="">
                                <h3>'.$row['denumire'].'</h3>
                                <div class="price">
                                '.$row['pret'].'
                                </div>
                                <div class="quantity">
                                    <span>cantitate</span>
                                    <input type="number" min="1" max="100" value="1">
                                    <span> /kg</span>
                                </div>
                                <input type="submit" value="Adauga in cos" class="btn"></input>
                            </form>
                            ';
                        }
                    }
                }
            ?>
        </div>
            </section>









    
    <script src="js/main.js"></script>
    </body>
</html>