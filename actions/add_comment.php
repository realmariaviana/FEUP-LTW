<?php 

include_once('../database/db_comments.php');
include_once('../includes/session.php');


header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

    $story_id = $_POST['story_id'];
    $text = $_POST['text'];

insertComment($_SESSION['username'], $story_id, $text, gmdate('Y-m-d H:i:s'));

$comments = getComments($story_id);
 
echo json_encode($comments);

?>