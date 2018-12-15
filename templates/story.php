<?php

/**
 * Draw a Story insertion
 */
include_once('../database/db_comments.php');
  
function draw_story_form(){

  ?>
    <script src="../js/addThemes.js" defer>></script>
    <form method="post" action="../actions/add_story.php" id="storyForm">
        
        <div class="newStory">
        
        <label for="title"><b>Title</b></label> <br>
        <input type="text" name="title" placeholder="Title of the story" required><br>
        
        <label for="text">Body Text</label>
        <br>
        <textarea name="bodyForm" id="bodyForm" cols="100" rows="30" form="storyForm" placeholder="I will tell you a big story..." required></textarea>
        <br>
        <div class="themesDivision">
        <label for="themes">Themes: </label>
        <input type="text" id="inputThemes" list = "themesOptions" placeholder="story themes">
        <img id="addTheme" src="https://image.flaticon.com/icons/svg/59/59565.svg" alt="addTheme" width="10" height="10">

        <datalist id="themesOptions">
        
        <?php


        $themes = getThemes();
        foreach($themes as $k){

        ?>
        <option id="<?= $k['theme'] ?>"  value="<?= $k['theme'] ?>"> <?= $k['theme'] ?>
        
    <?php }
    unset($k);
    ?>
    </datalist> <br>
    </div>
    <button id="Add "> Add </button>
    </div>
    </form>
    
    <?php } ?>


<?php 

/**
 * Draw stories 
 */

function drawStories($key, $aux){
    switch($key){
        case "all":
        $stories = getAllStories();
        break;
        
        case "Themes":
        $stories = getStoriesWiththeme($aux);
        break;
        
        case "Users":
        $stories = getStoriesWithUsername($aux);
        break;
        
        case "Stories":
        $stories = getStoriesWithTitle($aux);
        break;
    }
?>

<script src="../js/votes.js" defer></script>

<?php
    foreach($stories as $story)
        drawStory($story);

    unset($story);
 }


 function drawStory($story){
     ?>
     <article id="<?= $story['entity_id']?>" class="story">
         <h1> <a href="../pages/stories.php?search=Stories&sub="> <?= $story['title']?> </a> </h1>
         <div>
        <img class="avatar" src="images/0.jpg" alt="" />
        <span><a href="../pages/profilePage.php?username=<?= $story['username']?>"> <?= $story['username']?> </a></span>
        </div>
        <p> <?=$story['body']?></p>
        <footer class="storyFooter"><?= $story['hour']?> 
        
        <div class="tags">
    <?php
        $themes = getStoryThemes($story['entity_id']);
        foreach($themes as $theme) { 
            foreach($theme as $value) ?>
            <p id ="<?=$value?>" class="tag" ><a href="../pages/stories.php?search=Themes&sub=<?=$value?>"><?= "#" . $value?></a></p>
        <?php }
        unset($value);
        unset($theme);
     ?>
     </div>
    <p class="votes">
    <label id="<?="number-down-votes-" . $story['entity_id']?>" for="numberOfDownVotes"> <?=numberDownVotes($story['entity_id'])['N']?></label>

    <?php if(voteddown($story['entity_id'], $_SESSION['username'])){?>
    <img class="downvote" id="<?="down-vote-" . $story['entity_id']?>" src="https://image.flaticon.com/icons/svg/25/25395.svg" width="20" height="20" alt="downVote">
    <?php } else{ ?>
   
    <img class="downvote" id="<?="down-vote-" . $story['entity_id']?>" src="https://image.flaticon.com/icons/svg/25/25237.svg" width="20" height="20" alt="downVote">
<?php } ?>

     <label id="<?="number-up-votes-" . $story['entity_id']?>"for="numberOfupVotes"> <?=numberUpVotes($story['entity_id'])['N']?></label>
     <?php if(votedup($story['entity_id'], $_SESSION['username'])){?>
     <img class="upvote" id="<?="up-vote-" . $story['entity_id']?>" src="https://image.flaticon.com/icons/svg/25/25423.svg" width="20" height="20" alt="upVote" >
     <?php } else{ ?>
     
     <img class="upvote" id="<?="up-vote-" . $story['entity_id']?>" src="https://image.flaticon.com/icons/svg/25/25297.svg" width="20" height="20" alt="upVote" >
     <?php } ?>
</p> 
    <label class="comment" data-id="<?= $story['entity_id']?>">Comments</label>
        </footer>
        </article>
 
 <?php   }
?>


