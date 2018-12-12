<?php 

include_once('../includes/session.php');
include_once('../database/db_comments.php');


if(!isset($_SESSION['username']))
die(header('Location: ../pages/login.php'));

$pattern = $_GET['text'];
$info = $_GET['about'];

switch($info){
    case 'Themes':
    $return  = themePattern($pattern);
    break;

    case 'Users':
    $return  = usernamePattern($pattern);
    break;
    
    case 'Stories':
    $return  = storiesPattern($pattern);
    break;

    default:
    $return = [array('erro' => 'estupido')];
}

echo json_encode($return);

?>