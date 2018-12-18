<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain username, password combination
   * exists in the database. Using password_hash with random salt that is saved in database
   */
  function verifyUser($username, $password) {
    $db = Database::instance()->db();
   
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch(); 
    return ($user !== false && password_verify($password . $user['salt'], $user['password']));
   }

  function insertUser($username,$email, $password, $birth, $img, $salt) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ? ,?,?, ?, ?)');
    $stmt->execute(array($username, $email, createPass($password), $salt, $birth, $img));
    
  }

  function createPass($password){
    $options = ['cost' => 12];
    return password_hash($password, PASSWORD_DEFAULT, $options);
  }
?>