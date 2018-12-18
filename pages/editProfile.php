<?php 

include_once('../templates/common.php');
include_once('../includes/session.php');
include_once('../database/db_comments.php');

 // Verify if user is logged in 
 if (!isset($_SESSION['username']))
    die(header('Location: ../pages/stories.php?search=all&sub=null'));

    $info = getUsernameInfo($_SESSION['username']);

    draw_header($_SESSION['username']);

    ?>

 <link rel="stylesheet" href="../css/profilePage.css">
<script src="../js/editProfile.js" defer></script>
<section id="profile">
    <div class="container-box">
        
        <div class="banner_inner d-flex align-items-center">
            <form action="../actions/editProfile.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        
        <div class="username-block">            
            <label for="name">Username: </label>    
            <input name="name" type="text" value="<?=$info['username']?>"> <br>
        </div>
  
        <div class="email-block">        
            <label for="email">Email: </label>   
            <input name="email" type="email" value="<?=$info['email']?>"> <br>
        </div>
                
        <div class="birth-block">
            <label for="birth">Birthday: </label>    
            <input name="birthday" type="date" value="<?=$info['birthday']?>"><br>

        </div>
        
        <div class="pic-block" >
            <label for="photo">Picture: </label>    
            <input name="photo" type="file" value="<?=$info['img']?>"><br>
        </div>
        
        <div class="oldpass-block" >
        
            <label for="old"> Old Password: </label>    
            <input name="oldpass" type="password"> <br>
        </div>
       
        <div class="password-block" >
            <label for="new"> New Password: </label>    
            <input id="newPassword" name="newpass" type="password"> <br>
        </div>

        <div class="rpassword-block">
            <label for="repeatnew"> Repeat New Password: </label>    
            <input id="rpassword" name="repeatnewpass" type="password"> <br>
        </div>
            <button id="save"type="submit">Save</button>
            
            
            </form>
        </div>
    </div>
</section>   
<?php

draw_footer();
?>