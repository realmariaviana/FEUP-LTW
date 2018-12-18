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

<section id="profile">
    <div class="container-box">
        <div class="banner_inner d-flex align-items-center">
            <form action="../actions/editProfile.php" method="post" enctype="multipart/form-data">
            <label for="name">Nome: </label>    
            <input name="name" type="text" value="<?=$info['username']?>"> <br>

            <label for="email">Email: </label>   
            <input name="email" type="text" value="<?=$info['email']?>"> <br>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label for="birth">Data de Nascimento: </label>    
            <input name="birthday" type="date" value="<?=$info['birthday']?>"><br>


            <label for="photo">Photo: </label>    
            <input name="photo" type="file" value="<?=$info['img']?>"><br>

            <label for="old"> Old Password: </label>    
            <input name="oldpass" type="password"> <br>

            <label for="new"> New Password: </label>    
            <input name="newpass" type="password"> <br>

            <button type="submit">Save</button>
            
            
            </form>
        </div>
    </div>
</section>   
<?php

draw_footer();
?>