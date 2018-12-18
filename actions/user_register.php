<?php 
include_once('../database/db_user.php');
include_once('../includes/session.php');
include_once('../actions/upload.php');



$username = htmlspecialchars($_POST['username']);
$passwordRepeat = $_POST['rpassword'];
$password = $_POST['password'];
$email = htmlspecialchars($_POST['email']);
$birth = $_POST['birth'];

$salt = random_bytes(10);


if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
    die(header('Location: ../pages/register.php'));
}

try {
    if($_FILES['photo']['name']!="")
        $target_file = upload($username);
    else
        $target_file = "../database/images/0.jpg";

    $pass = $password . $salt;
    
    insertUser($username, $email, $pass, $birth, $target_file, $salt);
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/stories.php?search=all&sub=null');
} catch (Exception $e) {
   die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
    }

?>

<?php

?>