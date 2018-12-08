<?php 
include_once('../database/db_comments.php');
include_once('../includes/session.php');

header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

    $story_id = $_POST['story_id'];
  
    try {
        addVote($story_id, $_SESSION['username'], $_POST['vote']);
   } catch (Exception $th) {
        deleteVote($story_id, $_SESSION['username'], $_POST['vote']);
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed voting!');  
    }
    
    echo json_encode([numberUpVotes($story_id), numberDownVotes($story_id)]);

    
?>