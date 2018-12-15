<?php 
include_once('../templates/common.php');
include_once('../templates/story.php');
include_once('../includes/session.php');


if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));
    
    $entity = $_GET['id'];
    $story = getStory($entity);
    $title = $_GET('title');
    draw_header($_SESSION['username']);

?>

<script src="../js/votes.js" defer></script>
<script src="../js/pageThemeScript.js" defer></script>

<?php

print_r($story);

drawStory($story);

draw_footer();
?>
