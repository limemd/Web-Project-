<?php
session_start();
include 'config.php';

$id=$_GET['edit'];


if(isset($_POST['update_produs']))
{
    $product_denumire = $_POST['product_denumire'];
    $product_pret = $_POST['product_pret'];
    $product_descriere = $_POST['product_descriere'];
    
    $img = $_FILES['product_imagine']['name'];
    $product_imagine = 'upload/'.$_FILES['product_imagine']['name'];
    $product_imagine_tmp_name=$_FILES['product_imagine']['tmp_name'];
    $product_image_folder='upload/'.$img;

    $product_categorie = $_POST['product_categorie'];
//  inserarea
 $update ="UPDATE produse SET denumire='$product_denumire', pret='$product_pret', descriere='$product_descriere', imagine='$product_imagine', id_categorie='$product_categorie' where id_produs = $id";
 $upload=mysqli_query($conn,$update) or die('eraore la updatare produs');
 if($upload)
 {
     move_uploaded_file($product_imagine_tmp_name,$product_image_folder);
     echo '<script>alert(Produs Updatat);</script>';
 }
 else
 {
    echo '<script>alert(Produs nu a fost updatat);</script>';
 }
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
</head>
<body>
<header class="header-admin">
        <div class="flex-admin">
            <div class="logo">
            <img src="img/logo.png" class="logo-admin" alt="">
             <a href="admin_produse.php" class="admin">Panel de <span>Admin</span></a>
            </div>
            
            <nav class="navbar">
            <a href="admin_produse.php">Produse</a>
            <a href="admin_categorii.php">Categorii</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_mesaje.php">Mesaje</a>
            </nav>

            <div class="account">
            <a href="logout.php" class="logout11" id="logout_user" onclick="return confirm('Te deloghezi?');">logout </a>
            </div>
             <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
            </div> 
            
            
        </div>
    </header>


    <div class="admin-container">
    <div class="admin-product centrat">
        <?php
        $selec = mysqli_query($conn,"SELECT * from produse where id_produs = $id");
        while ($row =mysqli_fetch_assoc($selec))
        {

         ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Update produs</h3>
                <input type="text" placeholder="DENUMIRE" name="product_denumire" class="box" required <?php echo "value = \"". $row['denumire'] ."\" "; ?> >
                <input type="number" placeholder="PRET" name="product_pret" class="box" required value=<?php echo $row['pret']; ?>>
                <input type="text" placeholder="DESCRIERE" id="admin_descriere" name="product_descriere" class="box" required <?php echo "value = \"". $row['descriere'] ."\" "; ?>>
                <input type="file" accept="image/png, image/jpeg, image/jpg"  placeholder="IMAGINE" name="product_imagine" class="box" required >


                <!-- <input type="select" placeholder="categorie" name="product_categorie" class="box"> -->
                <select name="product_categorie" id="" class="box">
                    <?php

                $sql_select_category = "SELECT * FROM categorie";
                $select_category_result = mysqli_query($conn, $sql_select_category);
                if ($select_category_result->num_rows > 0)
            {
                while( $row = mysqli_fetch_assoc($select_category_result))
                { ?>
                  <option class="option" value="<?php echo $row['id_categorie'] ?>"><?php echo $row['denumire']?></option>
                 <?php 
                };
            };
                
                    ?>
                   

                </select>

               


                <input type="submit" class="btn-add" name="update_produs" value="UPDATE">
                <a href="admin_produse.php" class="btn" id="inapoi" >Inapoi</a>
            </form>

            <?php };
            ?>
        </div>
</div>
    
<script src="js/admin.js"></script>
</body>
</html>