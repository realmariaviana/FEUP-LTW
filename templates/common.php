
<?php function draw_header($username){
/**
 * Draw the header that is equal in all pages and fixed
 */

?>

  <link rel="stylesheet" href="../css/common.css">
<!DOCTYPE html>
<html>

<head>
    <title> SociStory</title>
    <meta charset="utf-8">
    <meta name="author" content="Carlos Daniel Gomes">
    <script src="../js/comments.js" defer></script>
    <!-- if logged in show the account-->
</head>

<body>
    <header>
        <?php if($username != null) { ?>
           <nav>
           <div class="header">
            <a href="../pages/stories.php" class="logo">SociStory</a>
                <div class="topnav">
            <a href="../pages/profilePage.php"> <?=$username?></a>
            <a href="../pages/newStory.php"> + Story </a>
            <a href="../actions/user_logout.php">Logout</a>
            <a href="../pages/stories.php">Home</a>               
            </div>
            </div>


        <?php }  ?>
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
