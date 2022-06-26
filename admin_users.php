<?php
session_start();
include 'config.php';

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    mysqli_query($conn,"DELETE from users WHERE id_user =$id");
    header('Location:admin_users.php');
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

    <!-- afisare -->
    <div class="admin-container">
    <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Denumire</th>
                        <th>Actiune</th>
                    </tr>
                </thead>

                <?php
                  // $try=  "SELECT produse.imagine, produse.denumire,pret,descriere,produse.id_categorie, categorie.denumire from produse
            // join categorie on categorie.id_categorie  = produse.id_categorie;";
                $select0 = mysqli_query($conn,"SELECT * from users where username!='admin'");
                if ($select0->num_rows > 0)
                {
                while($rand=mysqli_fetch_assoc($select0))
                {
                ?>
                <tr>
                    <td><?php echo $rand['id_user']; ?></td>
                    <td><?php echo $rand['username']; ?></td>
                    <td>
                     <a href="admin_users.php?delete=<?php echo $rand['id_user'] ?>" class="btn" id="sterge"><i class="fas fa-trash"></i> Sterge</a>
                </td>
                </tr>

                <?php }
                 }
                 else
                 {
                     echo 'nus- users';
                 } ?>
            </table>
        </div>
                </div>


    <script src="js/admin.js"></script>

</body>
</html>