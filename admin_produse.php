<?php
session_start();
include 'config.php';


if(isset($_POST['adauga_produs']))
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
 $insert ="INSERT into produse(denumire,pret,descriere,imagine,id_categorie) values ('$product_denumire','$product_pret','$product_descriere','$product_imagine','$product_categorie')";
 $upload=mysqli_query($conn,$insert) or die('eraore la inserare produs nou');
 if($upload)
 {
     move_uploaded_file($product_imagine_tmp_name,$product_image_folder);
     echo '<script>alert(Produs Adaugat);</script>';
 }
 else
 {
    echo '<script>alert(Produs nu a fost adauagt);</script>';
 }
}

// stergerea
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    mysqli_query($conn,"DELETE from produse WHERE id_produs =$id");
    header('Location:admin_produse.php');
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
                <h3>Adauga produs nou</h3>
                <input type="text" placeholder="DENUMIRE" name="product_denumire" class="box" required>
                <input type="number" placeholder="PRET" name="product_pret" class="box" required>
                <input type="text" placeholder="DESCRIERE" id="admin_descriere" name="product_descriere" class="box" required>
                <input type="file" accept="image/png, image/jpeg, image/jpg"  placeholder="IMAGINE" name="product_imagine" class="box" required>


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

               


                <input type="submit" class="btn-add" name="adauga_produs" value="Adauga">
            </form>
        </div>

        <!-- afisare produse -->

        <?php
      
        


        ?>

        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>Imagine</th>
                        <th>Denumire</th>
                        <th>Pret</th>
                        <th>Descriere</th>
                        <th>Categorie</th>
                        <th colspan="2">Actiune</th>
                    </tr>
                </thead>

                <?php
                  $sel="SELECT id_produs,produse.imagine, produse.denumire as prod_den,pret,descriere,produse.id_categorie, categorie.denumire as cat_den from produse
                join categorie on categorie.id_categorie  = produse.id_categorie;";
                $sel1="SELECT * from produse;";
                $select0 = mysqli_query($conn,$sel);
                if ($select0->num_rows > 0)
                {

                while($rand=mysqli_fetch_assoc($select0))
                {
                ?>
                <tr>
                    <td><img src="<?php echo $rand['imagine']; ?>" height="100" width="90" alt=""></td>
                    <td><?php echo $rand['prod_den']; ?></td>
                    <td><?php echo $rand['pret']; ?></td>
                    <td><?php echo $rand['descriere']; ?></td>
                    <td><?php echo $rand['cat_den']; ?></td>
                    <td>
                        <a href="admin_update.php?edit=<?php echo $rand['id_produs'] ?>" id="edit" class="btn"><i class="fas fa-edit"></i> Editeaza</a>

                        <a href="admin_produse.php?delete=<?php echo $rand['id_produs'] ?>" class="btn" id="sterge"><i class="fas fa-trash"></i> Sterge</a>
                    </td>
                </tr>

                <?php }
                 }
                 else
                 {
                     echo 'nus- produse';
                 } ?>
            </table>
        </div>
    </div>

    <!-- cum selectam ceea ce e in select -->



    <script src="js/admin.js"></script>

</body>
</html>