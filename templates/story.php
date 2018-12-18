<?php

/**
 * Draw a Story insertion
 */
include_once('../database/db_comments.php');
  
function draw_story_form(){

  ?>
    <script src="../js/addThemes.js" defer>></script>
    <form method="post" action="../actions/add_story.php" id="storyForm">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf']?>">
        
        <div class="newStory">
            <h3>Post Story</h3>
           
            <input type="text" name="title" placeholder="Title of the story" required><br>
            
            
            <br>
            <textarea name="bodyForm" id="bodyForm" cols="100" rows="30" form="storyForm" placeholder="I will tell you a big story..." required></textarea>
            <br>
            <div class="themesDivision">
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
                <div class="buttons">
                    <ul>
                        <li><button id="Add "> Post </button></li>
                        <li><button><a href="../pages/stories.php?search=all&sub=null" title="">Cancel</a></button></li>
                    </ul>
                </div>
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
     $img = getImg($story['username']);
  
     ?>
     <article id="<?= $story['entity_id']?>" class="story">
         <div>
        <img class="avatar" src=<?=$img['img']?> alt="imgPerfil" />
        <span><a href="../pages/profilePage.php?username=<?= $story['username']?>"> <?= $story['username']?> </a></span>
        </div>
        <div class="story-descript">
            <a href="../pages/stories.php?search=Stories&sub=<?= $story['title']?>"> <?= $story['title']?> </a>
                    
            <p> <?=$story['body']?></p>
            
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
        </div>
        <div class="post-footer">
            <ul class="like-com">
                <li>
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
                    <label class="date" for="date"><?= $story['hour']?></label>
                </li>
                <li>
                <label for="date"><?=$story['hour']?></label>
                </li>
                <li>
                    <label class="comment" data-id="<?= $story['entity_id']?>">Comments</label>
                </li>
            </ul>
    </article>
 
 <?php   }
?>


