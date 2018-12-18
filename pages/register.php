<?php 
include_once('../templates/common.php');
include_once('../includes/session.php');

if(isset($_SESSION['username']))
  die(header('Location: ../pages/stories.php'));
  
draw_header(null);
?>

  <!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/register.css">
    </head>

    <body>
    <form method="post" action="../actions/user_register.php" enctype="multipart/form-data">
    <div class="boxed">
        <div class="container">
            <div class="title">
                    <span class="signup-title">
                        sign up
                    </span>
            </div>

            <div class="in">
                <div class="username-block" data-validate="Username is required">
                    <span class="label">Username</span>
                    <input class="input" type="text" name="username" placeholder="username">
                </div>

                <div class="email-block" data-validate="Email is required">
                     <span class="label">Email</span>
                     <input class="input" type="text" name="email" placeholder="email">
                </div>

                <div class="birth-block" data-validate = "Birth is required">
                    <span class="label">Birth</span>
                    <input class="input" type="date" name="birth" placeholder="birth">
                </div>

                <div class="pic-block" data-validate = "Pic is required">
                    <span class="label">Picture</span>
                    <input class="input" type="file" name="photo" placeholder="photo">
                </div>

                <div class="password-block" data-validate = "Password is required">
                    <span class="label">Password</span>
                    <input class="input" type="text" name="password" placeholder="password">
                </div>

                <div class="rpassword-block" data-validate="Password is required">
                    <span class="label">Password</span>
                    <input class="input" type="text" name="rpassword" placeholder="repeat password">
                </div>
            </div>
      
                <button type="submit" class="registerbtn">Register</button>
                <div class="containersignup">
                    <br>
                    <p>Already have an account? <a href="login.php">Sign in</a></p>
                </div>
        </div>
    </div>
    </form>
    </body>

<?php 
draw_footer();
?>