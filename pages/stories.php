<?php 
include_once('../templates/common.php');
include_once('../templates/story.php');
include_once('../includes/session.php');


if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));
    ?>
   <!--- <link rel="stylesheet" href="../css/mainPage.css">--->

<?php 
draw_header($_SESSION['username']);
$sub = $_GET['sub'];
$key = $_GET['search'];
$img = getImg($_SESSION['username']);
?>

<div class="row">
  <div class="side">
  <h2>About Me</h2>
      <h5>Photo of me:</h5>
      <img src=<?=$img['img']?> alt="Avatar" class="avatar">
      <p>Some text..</p>
      </div>
      <div class="main">
      <?php
drawStories($key,$sub);
draw_footer();
?>
   </div>