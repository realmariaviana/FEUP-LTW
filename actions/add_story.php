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

    $bool = true;
    
    try{
        insertStory($username, $title, $body, $hour);
        $id = getStoryId($username, $title, $body, $hour);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Story published');
        $size = count($themes);
        print_r($size);
        print_r($id);
        for($i = 0; $i < $size; $i++){   
            print_r($themes[$i]);
       
            try{ 
                if($themes[$i] != "")
                insertTheme(strtolower($themes[$i]));
            } catch(Exception $e){
                $bool = false;
                insertEntityTheme($id['id'],strtolower($themes[$i]));
            }

            if($bool)
                insertEntityTheme($id['id'],strtolower($themes[$i]));
           
                $bool = true;
    }
   
   
    }catch (Exception $e){
        echo 'ERROR' . $e->getMessage() . '\n';
        $_SESSION['messages'][] = array('type' => 'failled', 'content' => 'Story not published');

    }finally{
     header('Location: ../pages/stories.php');

    }
    
        
?>