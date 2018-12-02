<?php
include_once('./templates/tpl_common.php');
include_once('../includes/session.php');
include_once('../database/db_user.php');

 // Verify if user is logged in
 if (isset($_SESSION['username']))
    die(header('Location: stories.php'));

draw_header(null);
?>

<form action="./actions/user_login.php">
  <div class="container">
    <h1>Register</h1>
    <hr>
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit" class="loginbtn">Log in</button>
  </div>
  
  <div class="container signup">
    <p>Not registered? <a href="register.php">Sign up</a>.</p>
  </div>
</form>


<?php 
draw_footer();
?>
