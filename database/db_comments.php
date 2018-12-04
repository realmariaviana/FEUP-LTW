<?php
  include_once('../includes/database.php');

  /**
   * Inserts a new story into the database.
   */
  function insertStory($username, $title, $body, $hour) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO stories VALUES(NULL, ?,?,?,?)');
    $stmt->execute(array($username, $title, $body, $hour));
    return $db->lastInsertRowID();
  }

  /**
   * Insert theme
   */

   function insertTheme($id, $theme){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO themes VALUES(?, ?)');
    $stmt->execute(array($theme, $id));   
  
   }

  /** 
   * Inserts a new comment
   */

  function insertComment($user_id, $story_id, $body, $hour){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO comments VALUES(NULL, ?, ?, ?, ?)');
    $stmt->execute(array($username, $title, $body, $hour));   
  
  }

  /**
   * Returns a certain story from the database.
   */
  function getStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM stories WHERE story_id = ?');
    $stmt->execute(array($story_id));
    return $stmt->fetch();
  }

  /**
   * Deletes a certain story.
   */
  function deleteStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM stories WHERE story_id = ?');
    $stmt->execute(array($story_id));
  }
 
  /**
   * Deletes a comment
   */
  function deleteComment($comment_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM comments WHERE comment_id = ?');
    $stmt->execute(array($comment_id));
  }


  /**
   * Returns all stories from the database.
   */
  function getAllStories() {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM stories');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * return all themes in database
   */
  function getThemes(){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT DISTINCT theme FROM themes');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * return themes of a story
   */
  function getStoryThemes($id_story){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT DISTINCT theme FROM themes WHERE story = ?');
    $stmt->execute(array($id_story));
    return $stmt->fetchAll();
  }

?>