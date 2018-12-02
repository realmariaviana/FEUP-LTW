<?php
  include_once('../includes/database.php');

  /**
   * Inserts a new story into the database.
   */
  function insertStory($username, $title, $body, $hour) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO story VALUES(NULL, ?, ?, ?, ?, 0, 0)');
    $stmt->execute(array($username, $title, $body, $hour));
  }

  /** 
   * Inserts a new comment
   */

  function insertComment($user_id, $story_id, $body, $hour){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO comment VALUES(NULL, ?, ?, ?, ?)');
    $stmt->execute(array($username, $title, $body, $hour));   
  }

  /**
   * Returns a certain story from the database.
   */
  function getStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM story WHERE story_id = ?');
    $stmt->execute(array($story_id));
    return $stmt->fetch();
  }

  /**
   * Deletes a certain story.
   */
  function deleteStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM story WHERE story_id = ?');
    $stmt->execute(array($story_id));
  }
 
  /**
   * Deletes a comment
   */
  function deleteComment($comment_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM comment WHERE comment_id = ?');
    $stmt->execute(array($comment_id));
  }


?>