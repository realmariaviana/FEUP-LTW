<?php 

include_once('../database/db_comments.php');
include_once('../includes/session.php');


header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));


$spec = $_POST['spec'];


switch($spec){
    case "old":
    $stories = storiesDesc();
    break;
    
    case "feed":
    $stories = myComments($_SESSION['username']);
    break;

    case "votes":
    $stories = mostVoted();
    break;

    default:
    $stories = getAllStories();
    break;
}

foreach($stories as &$extra){
$extra['votesDownStory'] = numberDownVotes($extra['entity_id'])['N'];
$extra['votesUpStory'] = numberUpVotes($extra['entity_id'])['N'];
$extra['hivotedDown'] = voteddown($extra['entity_id'], $_SESSION['username']);
$extra['hivotedUp'] = votedup($extra['entity_id'], $_SESSION['username']);
$extra['img'] = getUsernameInfo($extra['username'])['img'];
$extra['tags'] = getStoryThemes($extra['entity_id']);
}

unset($extra);
echo json_encode($stories);
?>