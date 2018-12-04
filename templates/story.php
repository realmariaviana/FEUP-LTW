<?php

/**
 * Draw a Story insertion
 */
include_once('../database/db_comments.php');
    function draw_story_form(){

  ?>
  
    <form method="post" action="../action/add_story.php" id="storyForm">
        
        <div class="newStory">
        
        <label for="title"><b>Title</b></label>
        <input type="text" name="title" placeholder="Title of the story">
        
        <label for="text">Body Text</label>
        <textarea name="body" id="body" cols="30" rows="10" form="storyForm">I will tell you a big story...</textarea>

        <div class="themes">

        <?php

        $themes = getThemes();
        foreach($themes as $k){

        ?>
        
        <input type="checkbox" name="themes[]" > <?php echo $k?> <br>
        
        
        
    
    <?php }
    unset($k);
    ?>
    </div>
        <input type="text" name="themes[other]"> Other<br>
        <button type="submit" class="PublishSubmit"> Publish</button>
    </div>
    </form>
    
    <?php } ?>


<?php 
/**
 * Draw a comment Box 
 */

   function draw_comment_form(){
?>

        <form id="commentForm" method="post" action="../actions/add_comment.php">
        
        <textarea name="commentArea" id="commentArea" cols="30" rows="10" form="commentForm">Comment...</textarea>
        <button type="submit" classe="commentSubmit">Comment</button>

        </form>

    <?php } ?>


<?php 

/**
 * Draw stories 
 */

 function drawStories(){
    $stories = getAllStories();

    foreach($stories as $story)
        drawStory($story);
 }


 function drawStory($story){
     ?>
     <article>
         <h1><?= $story['title']?></h1>
        <div id="userStory"> <?= $story['username']?></div>
        <p> <?=$story['body']?></p>
        <footer><?= $story['hour']?></footer>
        </article>
 
 <?php   }
?>


