<?php 
include_once('../database/db_user.php');
include_once('../includes/session.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Loggin success');
    header('Location: ../pages/stories.php');
} else{
    $_SESSION['messages'][] = array('type' => 'error' , 'content' => 'Loggin failed');
    header('Location: ../pages/login.php');
}
?>
