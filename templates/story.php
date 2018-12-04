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

    unset($story);
 }


 function drawStory($story){
     ?>
     <article>
         <h1><?= $story['title']?></h1>
        <h4> <?= $story['username']?></h4>
        <p> <?=$story['body']?></p>
        <footer class="storyFooter"><?= $story['hour']?> 
        
        <div class="tags">
    <?php
        $themes = getStoryThemes($story['story_id']);
        foreach($themes as $theme) { 
            foreach($theme as $value) ?>
            <p class="tag"><?= "#" . $value?></p>
        <?php }
        unset($value);
        unset($theme);
     ?>
     </div>
    <p class="votes">
        <img src="https://image.flaticon.com/icons/svg/25/25237.svg" width="20" height="20" alt="downVote" onclick="">
        <img src="https://image.flaticon.com/icons/svg/25/25297.svg" width="20" height="20" alt="upVote" onclick="">

</p> 
    <label onclick="allcomments()">comments</label>
        </footer>
        </article>
 
 <?php   }
?>


