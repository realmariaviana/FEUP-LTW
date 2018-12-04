
<?php function draw_header($username){
/**
 * Draw the header that is equal in all pages and fixed
 */

?>

  <link rel="stylesheet" href="../css/common.css">
<!DOCTYPE html>
<html>

<head>
    <title> Cuscando</title>
    <meta charset="utf-8">
    <meta name="author" content="Carlos Daniel Gomes">
    <!--- Adicionar o ajax-->
    <!-- adicionar o css-->
    <!-- if logged in show the account-->
</head>

<body>
    <div class="header">
        

        <?php if($username != null) { ?>
           <nav> <ul>
            <li><?=$username?></li>
            <li><a href="../actions/user_logout.php">Logout</a> </li>
            </ul>
        <?php } ?>

            <?php if($username == null){?>
                <div class="topnav">
                    
                <div class="links">              
                <a href="../actions/user_logout.php">Logout</a>
                <a href="../pages/profilePage.php">Profile</a>
                <a href="../pages/mainPage.php">Home</a>
                </div>
            </div>
            <?php } ?>
        </nav>

    </header>


<?php
}
?>

<?php function draw_footer(){

?>
</body>

</html>
<?php
} 
?>
