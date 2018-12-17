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

    <form action="../actions/editProfile.php" method="post">
    <label for="name">Nome: </label>    
    <input name="name" type="text" value="<?=$info['username']?>"> <br>

    <label for="email">Email: </label>   
    <input name="email" type="text" value="<?=$info['email']?>"> <br>
 
    <label for="birth">Data de Nascimento: </label>    
    <input name="birthday" type="date" value="<?=$info['birthday']?>"><br>

    <label for="old"> Old Password: </label>    
    <input name="oldpass" type="password"> <br>

    <label for="new"> New Password: </label>    
    <input name="newpass" type="password"> <br>

    <button type="submit">Save</button>
    
    
    </form>

<?php

draw_footer();
?>