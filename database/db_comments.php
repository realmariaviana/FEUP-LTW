<?php
  include_once('../includes/database.php');

  /**
   * Inserts a new story into the database.
   */
  function insertStory($username, $title, $body, $hour) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO stories VALUES(NULL, ?,?,?,?)');
    $stmt->execute(array($username, $title, $body, $hour));
  }

  function getStoryId($username, $title, $body, $hour){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT story_id as id FROM stories WHERE username = ? AND title = ? AND body = ? AND hour = ?');
    $stmt->execute(array($username, $title, $body, $hour));
    return $stmt->fetch();
 
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
    $stmt->execute(array($user_id, $story_id, $body, $hour));   
  
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

/**
 * return the comments of a story
 */
  function getComments($story_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM comments where story_id = ? ORDER BY hour DESC');
    $stmt->execute(array($story_id));
    return $stmt->fetchAll();
  }


  /**
   * return number of up votes
   */

  function numberUpVotes($story_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM likes where story_id = ?');
    $stmt->execute(array($story_id));
    return $stmt->fetch();
  }

  
  /**
   * return number of up votes
   */

  function numberDownVotes($story_id ){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM dislikes where story_id = ?');
    $stmt->execute(array($story_id));
    return $stmt->fetch();
  }

  function addVote($story_id, $username, $like){
    $db = Database::instance()->db();
    if($like === "true")
      $stmt = $db->prepare('INSERT INTO likes Values(?,?)');  
    else
      $stmt = $db->prepare('INSERT INTO dislikes Values(?,?)');
    $stmt->execute(array($story_id, $username));
  }

    function deleteVote($story_id, $username, $like){
      $db = Database::instance()->db();
      if($like === "true")
      $stmt = $db->prepare('DELETE FROM likes where story_id = ? and username = ?');
      else
      $stmt = $db->prepare('DELETE FROM dislikes where story_id = ? and username = ?');
      $stmt->execute(array($story_id, $username));
      }
  




  /**
   * return number of up votes for a comment
   */

  function numberUpVotesC($comment_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM likes_c where comment_id = ?');
    $stmt->execute(array($comment_id));
    return $stmt->fetch();
  }

  
  /**
   * return number of up votes
   */

  function numberDownVotesC($comment_id ){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM dislikes_c where comment_id = ?');
    $stmt->execute(array($comment_id));
    return $stmt->fetch();
  }

  function addVoteC($comment_id, $username, $like){
    $db = Database::instance()->db();
    if($like === "true")
      $stmt = $db->prepare('INSERT INTO likes_c Values(?,?)');  
    else
      $stmt = $db->prepare('INSERT INTO dislikes_c Values(?,?)');
    $stmt->execute(array($comment_id, $username));
  }

    function deleteVoteC($comment_id, $username, $like){
      $db = Database::instance()->db();
      if($like === "true")
      $stmt = $db->prepare('DELETE FROM likes_c where comment_id = ? and username = ?');
      else
      $stmt = $db->prepare('DELETE FROM dislikes_c where comment_id = ? and username = ?');
      $stmt->execute(array($comment_id, $username));
      }

?>