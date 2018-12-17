<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($username, $password) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch()?true:false; // return true if a line exists
  }

  function insertUser($username,$email, $password, $birth, $img) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ? ,?,?, ?)');
    $stmt->execute(array($username, $email, sha1($password), $birth, $img));
    
  }
?>