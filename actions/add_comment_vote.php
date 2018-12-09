<?php 
include_once('../database/db_comments.php');
include_once('../includes/session.php');

header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

    $comment_id = $_POST['comment_id'];
  
    try {
        addVoteC($comment_id, $_SESSION['username'], $_POST['vote']);
   } catch (Exception $th) {
        deleteVoteC($comment_id, $_SESSION['username'], $_POST['vote']);
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed voting!');  
    }
    
    echo json_encode([numberUpVotesC($comment_id), numberDownVotesC($comment_id)]);

    
?>