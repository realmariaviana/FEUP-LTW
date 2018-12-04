<?php
include_once('../templates/common.php');
include_once('../includes/session.php');

 // Verify if user is logged in 
 if (isset($_SESSION['username']))
    die(header('Location: ../pages/stories.php'));

draw_header(null);
?>
  <link rel="stylesheet" href="../css/mainPage.css">

    <div class="sidebar">
        <a href="profilePage.php" title="Profile">
            <img src="images/feup.png" alt="User name" class="img-user">
        </a>
        <h2 class="text"><a href="profilePage.php" title="Profile">My User</a></h2>
        <p class="description">
            <i><?=$_SESSION['username']?></i>
        </p>
    </div>
<?php 
draw_footer();
?>