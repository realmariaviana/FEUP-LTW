<?php 

include_once('../database/db_comments.php');
include_once('../includes/session.php');


header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));


    $story_id = $_POST['story_id'];
 
    $comments = getComments($story_id);
    $open = true;
    echo json_encode($comments, $open);
?>