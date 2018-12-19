<?php 
include_once('../templates/common.php');
include_once('../templates/story.php');
include_once('../includes/session.php');


if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));
    
    $theme = $_GET['id'];

    draw_header($_SESSION['username']);

?>

<div>
<p>
<?=
$theme;
?>
</p>
</div>

<script src="../js/votes.js" defer></script>
<script src="../js/pageThemeScript.js" defer></script>

<?php
$storiesIds = getStoriesWiththeme($theme);

foreach($storiesIds as $id){
    $story = getStory($id['entity_id']);
    drawStory($story);
}

draw_footer();
?>
