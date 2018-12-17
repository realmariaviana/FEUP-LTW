<?php
include_once('../templates/common.php');
include_once('../includes/session.php');
include_once('../database/db_comments.php');

 // Verify if user is logged in 
 if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$user =  $_GET['username'];
$profileInfo = getUsernameInfo($_GET['username']);
$mystories = myStories($_GET['username']);
$myCommentStories =  myComments($_GET['username']);

draw_header($_SESSION['username']);
if($user == $_SESSION['username']){
    ?>

    <script  src="../js/editButton.js" defer></script>

    <?php
}
?>
 <!-- <link rel="stylesheet" href="../css/profilePage.css">

    <div class="sidebar">
        <a href="profilePage.php" title="Profile">
            <img src="images/0.jpg" alt="User name" class="img-user">
        </a>
        <h2 class="text"><a href="profilePage.php" title="Profile"></a>
        <i><?=$_SESSION['username']?></i>
        </h2>
        <p class="description">
            
        </p>
    </div>--->

    <section id="profile">
     <p class="profileinfo" id = username>
     <label for="name">Nome: </label>
     <span> <?=$profileInfo['username']?></span>
     </p> 
    <p class="profileinfo" id = email>
    <label for="email">Email: </label>
     <span> <?=$profileInfo['email']?></span>
    </p>
    <p class="profileinfo" id = bd>
    <label for="birth">Data de Nascimento: </label>
     <span> <?=$profileInfo['birthday'] ?? 'No day inserted'?></span>
    </p>

    <p class="profileinfo" id = myStories>
    <label for="myStories"> My Stories </label>
     <ul>
     <?php 
     foreach($mystories as $story){
         ?>
        <li><?=$story['title']?> </li>   
       
    <?php }
    unset($story) ?>
   </ul>
    </p>
    
    <p class="profileinfo" id ="myCommentedStories">
    <label for="myCommentedStories"> Stories i follow </label>
     <ul>
     <?php 
     foreach($myCommentStories as $story){
         ?>
        <li><?=$story['title']?> </li>   
       
    <?php } 
    unset($story) ?>
   </ul>
    </p>
    </section>


<?php 
draw_footer();
?>