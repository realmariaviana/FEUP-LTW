<?php 
include_once('../templates/common.php');
include_once('../includes/session.php');

if(isset($_SESSION['username']))
  die(header('Location: ../pages/stories.php?search=all&sub=null'));
  
draw_header(null);
?>

  <link rel="stylesheet" href="../css/register.css">

<form method="post" action="../actions/user_register.php"  enctype="multipart/form-data">
<div class="container">
        <div class="title">
            <div class="title-image" style="background-image: url(images/feup.png);">
                <span class="login-title">
                    Sign Up
                </span>
        </div>
    <div class="in">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="username" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="birth"><b>Birth</b></label>
    <input type="date" name="birth" > <br>

    <label for="image"><b>Photo</b></label>
    <input type="file" name="photo" ><br>
    
    <label for="psw"><b>Password</b></label>
    <input id="password" type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input id="repeat-password" type="password" placeholder="Repeat Password" name="psw-repeat" required>
     
     <button type="submit" class="registerbtn" name="submit">Register</button>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>
<?php 
draw_footer();
?>