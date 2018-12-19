<?php 
include_once('../database/db_comments.php');
include_once('../includes/session.php');

header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

    $entity_id = $_POST['entity_id'];
  


    try {
        addVote($entity_id, $_SESSION['username'], $_POST['vote']);
   } catch (Exception $th) {
        deleteVote($entity_id, $_SESSION['username'], $_POST['vote']);
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed voting!');  
   }
    

    echo json_encode([numberUpVotes($entity_id), numberDownVotes($entity_id), votedup($entity_id, $_SESSION['username']), voteddown($entity_id, $_SESSION['username'])]);

    
?>