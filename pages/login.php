<?php
include_once('../templates/common.php');
include_once('../includes/session.php');

 // Verify if user is logged in 
 if (isset($_SESSION['username']))
    die(header('Location: ../pages/stories.php'));

draw_header(null);
?>
  <link rel="stylesheet" href="../css/login.css">

<form method="post" action="../actions/user_login.php">
    <div class="container">
        <div class="title">
            <div class="title-image" style="background-image: url(images/feup.png);">
                <span class="login-title">
                    Log In
                </span>
        </div>
        <div class="in">
            <div class="username-block" data-validate="Username is required">
                <span class="label">Username</span>
                <input class="input" type="text" name="username" placeholder="Enter username">
            </div>

            <div class="password-block" data-validate = "Password is required">
                <span class="label">Password</span>
                <input class="input" type="password" name="pass" placeholder="Enter password">
                
            </div>
        </div>
            <div>
                <a href="#" class="txt1">
                    Forgot Password?
                </a>
            </div>

            <button type="submit" class="loginbtn">Log in</button>
       
            <div class="container signup">
          <p>Not registered? <a href="register.php">Sign up</a>.</p>
        </div>
        </div>
    </div>
</form>


<?php 
draw_footer();
?>
