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



try {

if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    throw new Exception("Username can only contain letters and numbers!");
}

if(!(preg_match("/^([_@$%]|[a-z])+([0-9])([0-9]|[_@$%]|[a-z])*([A-Z])([0-9]|[_@$%]|[a-z]|[A-Z])*$/", $password) || preg_match("/^([_@$%]|[a-z])+([A-Z])([A-Z]|[_@$%]|[a-z])*([0-9])([0-9]|[_@$%]|[a-z]|[A-Z])*$/", $password))){
    throw new Exception("Pay attention in your pass");
} 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        throw new Exception("email is invalid");
    }

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
<<<<<<< HEAD
   die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
=======
  //die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => $e->getMessage());
    die(header('Location: ../pages/register.php'));
>>>>>>> f4857a258dc0669071a4c10ac5c77150bb15e6c4
    }

?>

<?php

?>