<?php
session_start();
include 'config.php';
if(isset($_SESSION['id_user']))
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

            <form action="search.php" class="search-box-container" method="post">
                <input type="search" id="search-box" placeholder="Cauta aici...">
                
                <asp:Label for="search-box" class="fas fa-search" id="asp" onclick="window.location='search.php';"></asp:Label>
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

<!-- afisarea produselor dupa categorie -->

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
} else
{
    header('Location:login.php');
}

}
?>








<section class="product" id="product">
<div class="box-container">
    <?php
        if(isset($_GET['id_categorie']))
        {
            $id_cat = $_GET['id_categorie'];
            $query1 = "SELECT * from produse  WHERE id_categorie='$id_cat'";
            $rez1 = mysqli_query($conn, $query1);
            if ($rez1->num_rows > 0)
            {
                while( $row = mysqli_fetch_assoc($rez1)){
                    
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
            else
            echo 'nu-s produse in aceasta categorie';
        }
        else echo 'nu e trimis id categorie';
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