<?php
include_once('../templates/common.php');
include_once('../includes/session.php');

 // Verify if user is logged in 
 if (isset($_SESSION['username']))
    die(header('Location: ../pages/stories.php?search=all&sub=null'));

draw_header(null);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/login.css">
    </head>

    <body>
    <form method="post" action="../actions/user_login.php">
    <div class="boxed">
        <div class="container">
            <div class="title">
                    <span class="login-title">
                        welcome
                    </span>
            </div>

            <div class="in">
                <div class="username-block" data-validate="Username is required">
                    <span class="label">Username</span>
                    <input class="input" type="text" name="username" placeholder="username">
                </div>

                <div class="password-block" data-validate = "Password is required">
                    <span class="label">Password</span>
                    <input class="input" type="password" name="password" placeholder="password">
                </div>
            </div>
            
           
                <button type="submit" class="loginbtn">Log in</button>
                <div>
                    <a href="#" class="txt1">
                        Forgot Password?
                    </a>
                </div>
           
                <div class="containersignup">
                    <br><br><br><br><br><br><br>
                    <p>Not registered?<a href="register.php">Sign up</a></p>
                </div>
        </div>
    </div>
    </form>
    </body>


<?php 
draw_footer();
?>
