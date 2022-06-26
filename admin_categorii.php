<?php
session_start();
include 'config.php';


if(isset($_POST['adauga_categorie']))
{
    $product_denumire = $_POST['product_denumire'];

    $img = $_FILES['product_imagine']['name'];
    $product_imagine = 'upload/'.$_FILES['product_imagine']['name'];
    $product_imagine_tmp_name=$_FILES['product_imagine']['tmp_name'];
    $product_image_folder='upload/'.$img;

//  inserarea
 $insert ="INSERT into categorie(denumire,imagine) values ('$product_denumire','$product_imagine')";
 $upload=mysqli_query($conn,$insert) or die('eraore la inserare categorie noua');
 if($upload)
 {
     move_uploaded_file($product_imagine_tmp_name,$product_image_folder);
     echo '<script>alert(Categorie Adaugata);</script>';
 }
 else
 {
    echo '<script>alert(Categoria nu a fost adaugata);</script>';
 }
}

// stergerea
if(isset($_GET['delete']))
{
    $id_cat=$_GET['delete'];
    mysqli_query($conn,"DELETE from categorie WHERE id_categorie =$id_cat");
    header('Location:admin_categorii.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <!-- sectiunea produse -->
    <div class="admin-container">
        <div class="admin-product">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Adauga Categorie noua</h3>
                <input type="text" placeholder="DENUMIRE" name="product_denumire" class="box" required>
                <input type="file" accept="image/png, image/jpeg, image/jpg"  placeholder="IMAGINE" name="product_imagine" class="box" required>
               


                <input type="submit" class="btn-add" name="adauga_categorie" value="Adauga">
            </form>
        </div>

        <!-- afisare categorii -->

        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>Imagine</th>
                        <th>Denumire</th>
                        <th colspan="2">Actiune</th>
                    </tr>
                </thead>

                <?php
                  // $try=  "SELECT produse.imagine, produse.denumire,pret,descriere,produse.id_categorie, categorie.denumire from produse
        // join categorie on categorie.id_categorie  = produse.id_categorie;";
                $select0 = mysqli_query($conn,"SELECT * from categorie");
                if ($select0->num_rows > 0)
                {

                while($rand=mysqli_fetch_assoc($select0))
                {
                ?>
                <tr>
                    <td><img src="<?php echo $rand['imagine']; ?>" height="100" width="90" alt=""></td>
                    <td><?php echo $rand['denumire']; ?></td>
                    <td><a href="admin_update_cat.php?edit=<?php echo $rand['id_categorie'] ?>" class="btn"><i class="fas fa-edit"></i> Editeaza</a>

                    <a href="admin_categorii.php?delete=<?php echo $rand['id_categorie'] ?>" class="btn" id="sterge"><i class="fas fa-trash"></i> Sterge</a>
                </td>
                </tr>

                <?php }
                 }
                 else
                 {
                     echo 'nus- categorii';
                 } ?>
            </table>
        </div>
    </div>







    <script src="js/admin.js"></script>

</body>
</html>