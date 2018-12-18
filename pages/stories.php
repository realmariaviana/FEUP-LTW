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
      <div class="main">
      <div class="post-story">
                <div class="user-pic">
                    <img src=<?=$img['img']?> alt="Avatar" class="avatar">
                </div>
                <a href="../pages/newStory.php"> New Story </a>
            </div>
      <?php
drawStories($key,$sub);
draw_footer();
?>
   </div>