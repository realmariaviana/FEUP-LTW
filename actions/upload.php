<?php 

include_once('../includes/session.php');

function upload($username){

$extension =  strtolower(pathinfo( basename($_FILES["photo"]["name"]),PATHINFO_EXTENSION));
$target_dir = "../database/images/" ;
$target_file = $target_dir . $username . "." . $extension;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check == false) {
       throw new Exception("is not an image");
    }
}

// Check file size
if ($_FILES["photo"]["size"] > 5000000) {
    throw new Exception("File is too large");
}
// Allow certain file formats
if($extension != "jpg" && $extension != "png" && $extension != "jpeg"
&& $extension != "gif" ) {
  throw new Exception("bad extension");
}

if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    throw new Exception("Failled movind the file");
}
return $target_file;

}
?>