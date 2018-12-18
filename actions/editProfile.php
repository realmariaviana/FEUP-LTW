<?php 

include_once('../templates/common.php');
include_once('../includes/session.php');
include_once('../database/db_comments.php');
include_once('../database/db_user.php');

include_once('../actions/upload.php');

 // Verify if user is logged in 

    if ($_SESSION['csrf'] !== $_POST['csrf']){
        print_r("this is suspicious");
        return;
    }
 if (!isset($_SESSION['username']) || !isset($_POST['name']))
    die(header('Location: ../pages/stories.php?search=all&sub=null'));

$info = getUsernameInfo($_SESSION['username']);
$username = $_POST['name'];
$email = $_POST['email'];
$birth = $_POST['birthday'];
$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$img = $info['img'];
$salt = $info['salt'];

try {

 if($_FILES['photo']['name'] != "")
   $img = upload($username);

    if(verifyUser($info['username'], $oldpass) && $oldpass != ""){
        throw new Exception("pass's dont match");
    }
    else if($newpass != ""){
        //check para a new pass
         $pass = createPass($newpass . $salt);
    }
    else
    $pass = $info['password'];

    editProfile($username, $birth, $pass, $email, $img ,$info['rowid'], $salt);
    $_SESSION['username'] = $username;
    header("Location: ../pages/profilePage.php?username=" . $username);

} catch (Exception $th) {
    //die($th->getMessage());
    $_SESSION['messages'][] =array( 'type' => 'fail', 'content' => 'Fail editing profile');
    
    header("Location: ../pages/editProfile.php");
}


?>