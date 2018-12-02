<?php
include_once('../templates/common.php');
include_once('../includes/session.php');

 // Verify if user is logged in
 if (isset($_SESSION['username']))
    die(header('Location: stories.php'));

draw_header(null);
?>

<form method="post" action="../actions/user_login.php">
  <div class="container">
    <h1>Log in</h1>
    <hr>
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" class="loginbtn">Log in</button>
  </div>
  
  <div class="container signup">
    <p>Not registered? <a href="register.php">Sign up</a>.</p>
  </div>
</form>


<?php 
draw_footer();
?>
