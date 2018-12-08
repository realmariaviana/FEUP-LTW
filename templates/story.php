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
 * Draw stories 
 */

function drawStories(){
    $stories = getAllStories();
?>

<script src="../js/votes.js" defer></script>

<?php
    foreach($stories as $story)
        drawStory($story);

    unset($story);
 }


 function drawStory($story){
     ?>
     <article id="<?= $story['story_id']?>" class="story">
         <h1><?= $story['title']?></h1>
        <h4> <?= $story['username']?></h4>
        <p> <?=$story['body']?></p>
        <footer class="storyFooter"><?= $story['hour']?> 
        
        <div class="tags">
    <?php
        $themes = getStoryThemes($story['story_id']);
        foreach($themes as $theme) { 
            foreach($theme as $value) ?>
            <p id ="<?=$value?>" class="tag" ><?= "#" . $value?></p>
        <?php }
        unset($value);
        unset($theme);
     ?>
     </div>
    <p class="votes">
    <label id="<?="number-down-votes-" . $story['story_id']?>" for="numberOfDownVotes"> <?=numberDownVotes($story['story_id'])['N']?></label>

    <img class="downvote" id="<?="down-vote-" . $story['story_id']?>" src="https://image.flaticon.com/icons/svg/25/25237.svg" width="20" height="20" alt="downVote">
     
     <label id="<?="number-up-votes-" . $story['story_id']?>"for="numberOfupVotes"> <?=numberUpVotes($story['story_id'])['N']?></label>
     <img class="upvote" id="<?="up-vote-" . $story['story_id']?>" src="https://image.flaticon.com/icons/svg/25/25297.svg" width="20" height="20" alt="upVote" >

</p> 
    <label class="comment" data-id="<?= $story['story_id']?>">comments</label>
        </footer>
        </article>
 
 <?php   }
?>


