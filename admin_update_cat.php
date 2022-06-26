<?php
session_start();
include 'config.php';

$id=$_GET['edit'];


if(isset($_POST['update_categorie']))
{
    $product_denumire = $_POST['product_denumire'];
    
    $img = $_FILES['product_imagine']['name'];
    $product_imagine = 'upload/'.$_FILES['product_imagine']['name'];
    $product_imagine_tmp_name=$_FILES['product_imagine']['tmp_name'];
    $product_image_folder='upload/'.$img;

//  inserarea
 $update ="UPDATE categorie SET denumire='$product_denumire', imagine='$product_imagine' where id_categorie = $id";
 $upload=mysqli_query($conn,$update);
 if($upload)
 {
     move_uploaded_file($product_imagine_tmp_name,$product_image_folder);
     echo '<script>alert(Categorie Updatata);</script>';
 }
 else
 {
    echo '<script>alert(Categoria nu a fost updatata);</script>';
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
        $selec = mysqli_query($conn,"SELECT * from categorie where id_categorie = $id");
        while ($row =mysqli_fetch_assoc($selec))
        {

         ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Update Categorie</h3>
                <input type="text" placeholder="DENUMIRE" name="product_denumire" class="box" required <?php echo "value = \"". $row['denumire'] ."\" "; ?> >

                <input type="file" accept="image/png, image/jpeg, image/jpg"  placeholder="IMAGINE" name="product_imagine" class="box" required >


               


                <input type="submit" class="btn-add" name="update_categorie" value="UPDATE">
                <a href="admin_categorii.php" class="btn" id="inapoi" >Inapoi</a>
            </form>

            <?php };
            ?>
        </div>
</div>
    
<script src="js/admin.js"></script>
</body>
</html>