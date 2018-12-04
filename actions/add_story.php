<?php 

    include_once('../includes/session.php');
    include_once('../database/comments.php');

    date_default_timezone_set('Europe/Lisbon');
    if(!issset($_POST['username']))
        die(header('Location: ../pages/login.php'));

    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $themes = $_POST['themes'];

    $hour = gmdate('Y-m-d H:i:s');

    try{
        $id =  insertStory($username, $title, $body, $hour);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Story published');
        foreach($themes as $theme){   
            insertTheme($id, strtolower($theme));
        }

        header('Location: ../pages/stories.php');
    }catch (Exception $e){
        echo 'ERROR' . $e->getMessage() . '\n';
        $_SESSION['messages'][] = array('type' => 'failled', 'content' => 'Story not published');

    }   
    
    
        
?>