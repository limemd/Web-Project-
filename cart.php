<?php
include 'config.php';
session_start();

if (isset($_SESSION['username']))
{
     $utilizator = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username='$utilizator'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_user= $row['id_user'];
      //  echo $id_user;
    }
}
else {
    // echo '<script>alert("GUEST");</script>';
    $id_user = NULL;
    echo 'GUEST';
    //imi ia id-ul la utilizatorul logat..de exe petru  =8 
    // if($id_user==NULL)
    // echo 'nul';
}

if(!isset($id_user)){
    header('Location:login.php');
};

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

<!-- shopping cart cart -->

        <div class="container" id="body">

            
            <div class="shopping-cart">
                <h1 class="heading">
                    Cos de cumparaturi
                </h1>
                <table>
                    <thead>
                        <th>Imagine</th>
                        <th>Denumire</th>
                        <th>Pret</th>
                        <th>Cantitate</th>
                        <th>Total</th>
                        <th>Actiune</th>
                    </thead>
                    <tbody>


                    <!-- update -->
                    <?php
                if(isset($_POST['update']))
                {
                    $update_cantitate = $_POST['cantitate_cos'];
                    $update_id = $_POST['id_cart'];
                    mysqli_query($conn,"UPDATE cart set cantitate='$update_cantitate' where id_cart = '$update_id'") or die('eroare la updaye');
                    //echo "<script>alert('Update efecutat!')</script>";
                    // echo "<meta http-equiv=\"refresh\" content=\"1; URL='cart.php'\" >";
                    header('Location:cart.php');

                } 

                if(isset($_GET['remove'])){
                    $remove_id = $_GET['remove'];
                    mysqli_query($conn, "DELETE from cart where id_cart = '$remove_id'") or die ('eroare la stergere');
                    echo "<script>alert('Sters cu succes!')</script>";
                    header('Location:cart.php');
                }

                if(isset($_GET['delete_all']))
                {
                    mysqli_query($conn, "DELETE from cart where id_user = '$id_user'") or die ('eroare la stergere');
                }
                ?>
                   
                    <?php
                    $total  =0;
                    $cart_query=mysqli_query($conn,"SELECT * from cart where id_user = '$id_user'") or die('eroare la cart_query');

                    if(mysqli_num_rows($cart_query)>0)
                    {
                        while($row = mysqli_fetch_assoc($cart_query))
                        {
                            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $row['imagine']; ?>" height="130" width="120" class="img-cart" alt="">
                                </td>
                                <td>
                                    <?php echo $row['denumire'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['pret'] ;?>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_cart" value="<?php echo $row['id_cart'] ;?>">
                                        <input type="number" min="1" name="cantitate_cos" value="<?php echo $row['cantitate'] ;?>">
                                        <input type="submit" name="update" value="update" id="" class="btn">
                                    </form>
                                </td>

                                <td>
                                    <?php echo $subtotal =number_format($row['pret'] * $row['cantitate']) ?> LEI/-
                                </td>
                                <td>
                                    <a href="cart.php?remove=<?php echo $row['id_cart']; ?>" class="btn" onclick="return confirm('Elimini produsul din cos?');" >Elimina</a>
                                </td>
                            </tr>
                         <?php
                            $total += $subtotal;
                            // echo $total;
                        }
                       
                    }
                    else
                    {
                        echo '<tr><td style="padding:20px;text-align:center;" colspan="6"  >nu sunt produse</td></tr>';
                        

                    }
                    ?>


<!-- veridicare daca se update din cos -->

          

                    <tr class="table-bottom">
                        <td colspan="4" id="colspan">
                            De achitat : 
                        </td>
                        <td>
                            <?php echo $total; ?>LEI/-
                        </td>
                        <td>
                            <a href="cart.php?delete_all" onclick="return confirm('Elimini tot din cos?');" class="btn <?php  echo ($total>1)?'':'disabled';  ?>" >Elimina tot</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="checkout">
                    <a href="#" class="btn-achita <?php  echo ($total>1)?'':'disabled';  ?>">Achita</a>
                </div>
            </div>
        </div>



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