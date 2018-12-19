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
    $repeatPass = $_POST['repeatnewpass'];
    $img = $info['img'];
    $salt = $info['salt'];

    
try {

    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
         throw new Exception("Username can only contain letters and numbers!");
    }
    
   if($newpass != "" && $repeatPass!= ""){
    if($newpass!=$repeatPass && !(preg_match("/^([_@$%]|[a-z])+([0-9])([0-9]|[_@$%]|[a-z])*([A-Z])([0-9]|[_@$%]|[a-z]|[A-Z])*$/", $newpass) || preg_match("/^([_@$%]|[a-z])+([A-Z])([A-Z]|[_@$%]|[a-z])*([0-9])([0-9]|[_@$%]|[a-z]|[A-Z])*$/", $newpass))){
        throw new Exception("Pay attention in your pass");
    } 
}
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        throw new Exception("email is invalid");
    }
    
    if($_FILES['photo']['name'] != "")
        $img = upload($username);

    
    if($newpass != "" && $newpass==$repeatPass && $oldpass != ""){
        if(!verifyUser($info['username'], $oldpass)){
            throw new Exception("pass's dont match");
        }

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