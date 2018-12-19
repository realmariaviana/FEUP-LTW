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
<script src="../js/sort.js" defer></script>
<script id="voteScript" src="../js/votes.js" defer></script>

<div class="row">
      <div class="main">
      <div class="post-story">
                <div class="user-pic">
                    <img src=<?=$img['img']?> alt="Avatar" class="avatar">
                </div>
                <nav id="sortNav"> 

                <input hidden  class="sorting" type="radio" name="sort" id="recent"> 
                <label for="recent">recent</label>
                <input  hidden class="sorting" type="radio" name="sort" id="old"> 
                <label for="old">old</label> 
                <input  hidden class="sorting" type="radio" name="sort" id="feed"> 
                <label for="feed">feed</label>
                <input  hidden class="sorting" type="radio" name="sort" id="votes">
                <label for="votes">votes</label>
                 
                </nav>
                <a href="../pages/newStory.php"> New Story </a>
            </div>
      <?php
drawStories($key,$sub);
draw_footer();
?>
   </div>