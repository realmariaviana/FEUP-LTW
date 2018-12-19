<?php 

    include_once('../includes/session.php');
    include_once('../database/db_comments.php');

    date_default_timezone_set('Europe/Lisbon');

    if ($_SESSION['csrf'] !== $_POST['csrf']){
        print_r("this is suspicious");
        return;
    }

    if(!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $username = htmlspecialchars($_SESSION['username']);
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['bodyForm']);
    $themes = $_POST['themes'];

    $hour = gmdate('Y-m-d H:i:s');

    $bool = true;
    
    try{
        insertStory($username, $title, $body, $hour);
        $id = getStoryId($username, $title, $body, $hour);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Story published');
        $size = count($themes);
    
        for($i = 0; $i < $size; $i++){   
        
            try{ 
                if($themes[$i] != "")
                insertTheme(htmlspecialchars(strtolower($themes[$i])));
            } catch(Exception $e){
                $bool = false;
                insertEntityTheme($id['id'],htmlspecialchars(strtolower($themes[$i])));
            }
            if($bool)
                insertEntityTheme($id['id'],htmlspecialchars(strtolower($themes[$i])));
           
            $bool = true;
    }
   
   
    }catch (Exception $e){
        echo 'ERROR' . $e->getMessage() . '\n';
        $_SESSION['messages'][] = array('type' => 'failled', 'content' => 'Story not published');

    }finally{
     header('Location: ../pages/stories.php?search=all&sub=null');

    }
    
        
?>