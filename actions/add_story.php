<?php 

    include_once('../includes/session.php');
    include_once('../database/db_comments.php');

    date_default_timezone_set('Europe/Lisbon');

    if(!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $body = $_POST['bodyForm'];
    $themes = $_POST['themes'];

    $hour = gmdate('Y-m-d H:i:s');

    try{
        
        insertStory($username, $title, $body, $hour);
        $id = getStoryId($username, $title, $body, $hour);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Story published');
        $size = count($themes);
       for($i = 0; $i < $size; $i++){   
           if($themes[$i] != "")
            insertTheme($id['id'], strtolower($themes[$i]));
        }
        
     
        unset($theme);
   }catch (Exception $e){
        echo 'ERROR' . $e->getMessage() . '\n';
        $_SESSION['messages'][] = array('type' => 'failled', 'content' => 'Story not published');

    }finally{
      header('Location: ../pages/stories.php');

    }
    
        
?>