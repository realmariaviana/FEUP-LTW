<?php
include_once('../templates/common.php');
include_once('../includes/session.php');

 // Verify if user is logged in 
 if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

draw_header($_SESSION['username']);
?>
  <link rel="stylesheet" href="../css/mainPage.css">

    <div class="sidebar">
        <a href="profilePage.php" title="Profile">
            <img src="images/0.jpg" alt="User name" class="img-user">
        </a>
        <h2 class="text"><a href="profilePage.php" title="Profile"></a>
        <i><?=$_SESSION['username']?></i>
        </h2>
        <p class="description">
            
        </p>
    </div>
<?php 
draw_footer();
?>