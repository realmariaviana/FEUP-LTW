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
 <link rel="stylesheet" href="../css/profilePage.css">

<div class="container">
    <div class="card">
        <h1><?=$_SESSION['username']?></h1>
            <img src="<?=$profileInfo['img']?>" alt="MyImg" style="width:100%"> 
        <div style="margin: 24px 0;">
            <ul class="single-category">
                <li class="row">
                    <h6 class="email">Email</h6>
                    <span> <?=$profileInfo['email']?></span> </li>
                <li class="row">
                    <h6 class="birthday">Birthday</h6>
                    <span> <?=$profileInfo['birthday'] ? $profileInfo['birthday'] :'No day inserted'?></span> </li>
            </ul>
            </div>
        <p><button>EDIT</button></p>
    </div>
         
    <section id="stories">
        <div class="container">
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
                    </div>
                    </div> 
            </section>   

        </section>
    </div>

<?php 
draw_footer();
?>

<!--    
<div id="main-wrapper"> 
<div class="compny-profile"> 
      <div class="profile-company-content has-bg-image" data-bg-color="f5f5f5" style="background-image: url(&quot;undefined&quot;); background-color: rgb(245, 245, 245);">
            <div class="container">
                <div class="row"> 
                
           /*     <div class="col-md-4"> 
                    <div class="sidebar">
                    <h5 class="main-title">Mike Tomlinson</h5>
                    <div class="sidebar-thumbnail"> <img src="images/avatar.jpg" alt=""> </div>
                    <div class="sidebar-information">
                        <ul class="single-category">
                        <li class="row">
                            <h6 class="email">Email</h6>
                            <span class="subtitle col-xs-6"> /*
                                </span> </li>
                        <li class="row">
                            <h6 class="birthday">Birthday</h6>
                            <span class="subtitle col-xs-6"></span> </li>
                        </ul>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
-->