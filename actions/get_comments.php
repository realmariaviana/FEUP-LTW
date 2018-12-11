<?php 

include_once('../database/db_comments.php');
include_once('../includes/session.php');


header('Content-Type: application/json');


if(!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));


    $entity_id = $_POST['entity_id'];
   
    $comments = getComments($entity_id);

    foreach($comments as &$bool){
        $bool['voteup'] = votedup($bool['entity_id'], $_SESSION['username']);
       $bool['votedown'] = voteddown($bool['entity_id'], $_SESSION['username']);
       $bool['upvotes'] = numberUpVotes($bool['entity_id'])['N'];
       $bool['downvotes'] = numberDownVotes($bool['entity_id'])['N'];
    }

    unset($bool);
    echo json_encode($comments);
?>