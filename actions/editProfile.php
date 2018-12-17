<?php 

include_once('../templates/common.php');
include_once('../includes/session.php');
include_once('../database/db_comments.php');

 // Verify if user is logged in 
 if (!isset($_SESSION['username']) || !isset($_POST['name']))
    die(header('Location: ../pages/stories.php?search=all&sub=null'));

$info = getUsernameInfo($_SESSION['username']);
$username = $_POST['name'];
$email = $_POST['email'];
$birth = $_POST['birthday'];
$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];


try {

    if(sha1($oldpass) != $info['password']  && $oldpass != ""){
        throw new Exception("pass's dont match");
    }
    else if($newpass != ""){
        //check para a new pass
         $pass = sha1($newpass);
    }
    else
    $pass = $info['password'];

    editProfile($username, $birth, $pass, $email, $info['rowid']);
    $_SESSION['username'] = $username;
    header("Location: ../pages/profilePage.php?username=" . $username);

} catch (Exception $th) {
    $_SESSION['messages'][] =array( 'type' => 'fail', 'content' => 'Fail editing profile');

   header("Location: ../pages/editProfile.php");
}


?>