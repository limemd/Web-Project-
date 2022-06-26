<?php
session_start();
include 'config.php';
if(isset($_SESSION['id_user']))
{
    $id_user = $_SESSION['id_user'];
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


    <!--Categoriile-->

    <section class="category" id="category">
        <h1 class="heading">
            Comanda dupa <span>categorie</span>
        </h1>
        <div class="box-container">
            <?php
            $sql_select_category = "SELECT * FROM categorie";
            $select_category_result = mysqli_query($conn, $sql_select_category);

            // schimbraile ******
            if ($select_category_result->num_rows > 0)
            {
                while( $row = mysqli_fetch_assoc($select_category_result))
                { ?>
                <div class="box">
                <h3><?php echo $row['denumire']?></h3>
                <img src="<?php echo $row['imagine']?>" alt="">
                <a  class="btn" href="produse.php?id_categorie=<?=$row['id_categorie']; ?>">Cumpara Acum</a>
                </div>
                 <?php
                };
            };
            ?>
            </div>
            <!-- <div class="box">
                <h3>Torturi</h3>
                <img src="img/tort1.jpg" alt="">
                <a href="#" class="btn">Cumpara Acum</a>

            </div>

            <div class="box">
                <h3>Cheesecakes</h3>
                <img src="img/tort2.jpg" alt="">
                <a href="#" class="btn">Cumpara Acum</a>
                
            </div>

            <div class="box">
                <h3>Prajituri</h3>
                <img src="img/tort3.jpg" alt="">
                <a href="#" class="btn">Cumpara Acum</a> -->
                
            <!-- </div>

            <div class="box">
                <h3>Alte delicii</h3>
                <img src="img/tort4.jpg" alt="">
                <a href="#" class="btn">Cumpara Acum</a>
                
            </div> -->
        
    </section>

<?php
if(isset($_POST['cos']))
{
    if(isset($_SESSION['id_user']))
    {
        $product_imagine=$_POST['product_imagine'];
        $product_denumire=$_POST['product_denumire'];
        $product_pret=$_POST['product_pret'];
        $product_cantitate=$_POST['product_cantitate'];

        $select_cart = mysqli_query($conn,"SELECT * from cart where denumire = '$product_denumire' and id_user='$id_user'") or die ('eroare la query');

        if(mysqli_num_rows($select_cart)>0)
        {
            // $mesaj[] = 'produsul e deja adaugat in cos!';
            echo "<script>alert('produsul e deja adaugat in cos!')</script>";

        }
        else
        {
            mysqli_query($conn, "INSERT into cart (id_user, denumire, pret, imagine, cantitate) values ('$id_user','$product_denumire','$product_pret','$product_imagine','$product_cantitate')") or die ('eroare introducere in bd cos!');
            // $mesaj[]='produs adaugat in cos!';
            echo "<script>alert('produs adaugat in cos!')</script>";
        }
    }
    else
    {
        header('Location:login.php');
    }

    
}
?>
    <!--Sectiunea Produse-->
    <section class="product" id="product" >
        <h1 class="heading">Produse <span>populare</span></h1>
        <div class="box-container">

        <?php
            $sql_select_products = "SELECT * FROM produse limit 3";
            $select_products_result = mysqli_query($conn, $sql_select_products);
            if ($select_products_result->num_rows > 0) {
               while( $row = mysqli_fetch_assoc($select_products_result)){

                ?>
                <form method="post" action="" class="box" >
            
                <img src="<?php echo $row['imagine']; ?>" alt="">
                <h3><?php echo $row['denumire']; ?></h3>
                <div class="price">
                <?php echo $row['pret']; ?>
                </div>
                <div class="quantity">
                    <span>cantitate</span>
                    <input type="number" name="product_cantitate" min="1" max="100" value="1">
                    <span> /kg</span>
                </div>
                <!-- hiden -->
                <input type="hidden" name="product_imagine" value="<?php echo $row['imagine']; ?>">

                <input type="hidden" name="product_denumire" value="<?php echo $row['denumire']; ?>">

                <input type="hidden" name="product_pret" value="<?php echo $row['pret']; ?>">
                <!-- hidden -->

                <input type="submit" name="cos" value="Adauga in cos" class="btn"></input>
            </form>
            <?php
                }
            }
                 
        ?>


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