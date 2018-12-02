
<?php function draw_header($username){
/**
 * Draw the header that is equal in all pages and fixed
 */

?>
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
    <header>
        <h1>CusCus</h1>
        <h2>O melhor sitio para Cuscar</h2>
        <!---<img src="" alt="">  -->  

        <?php if($username != null) { ?>
           
           <nav> <ul>
            <li><?=$username?></li>
            <li><a href="logout.php">Logout</a> </li>
            </ul>
        <?php } ?>

            <?php if($username == null){?>
            <li><a href="login.php"> log in </a></li>
            <li><a href="signup.php">sign up</a> </li>

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