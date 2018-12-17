<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function verifyUser($username, $password) {
    $db = Database::instance()->db();
   
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch(); 
    return ($user !== false && password_verify($password, $user['password']));
   }

  function insertUser($username,$email, $password, $birth, $img) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ? ,?,?, ?)');
    $stmt->execute(array($username, $email, createPass($password), $birth, $img));
    
  }

  function createPass($password){
    $options = ['cost' => 12];
    return password_hash($password, PASSWORD_DEFAULT, $options);
  }
?>