<?php 

include_once('../database/db_comments.php');
include_once('../includes/session.php');


header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

    $story_id = $_POST['story_id'];
    $text = $_POST['text'];

insertComment($story_id, $_SESSION['username'], $text, gmdate('Y-m-d H:i:s'));

$comments = getComments($story_id);

foreach($comments as &$bool){
    $bool['voteup'] = votedup($bool['entity_id'], $_SESSION['username']);
   $bool['votedown'] = voteddown($bool['entity_id'], $_SESSION['username']);
   $bool['upvotes'] = numberUpVotes($bool['entity_id'])['N'];
   $bool['downvotes'] = numberDownVotes($bool['entity_id'])['N'];
}
echo json_encode($comments);

?>