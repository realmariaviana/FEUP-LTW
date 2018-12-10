<?php 
include_once('../templates/common.php');
include_once('../templates/story.php');
include_once('../includes/session.php');


if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));
    ?>
    <link rel="stylesheet" href="../css/mainPage.css">

<?php 
draw_header($_SESSION['username']);
?>

<div class="row">
  <div class="side">
  <h2>About Me</h2>
      <h5>Photo of me:</h5>
      <img src="images/0.jpg" alt="Avatar" class="avatar">
      <p>Some text..</p>
      </div>
      <div class="main">
      <?php
drawStories();
draw_footer();
?>
   </div>