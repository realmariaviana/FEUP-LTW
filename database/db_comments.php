<?php
  include_once('../includes/database.php');

  /**
   * Create a new entity and return its id
   */
  function entity() {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('INSERT INTO entities VALUES(NULL)');
    $stmt->execute();
    $stmt = $db->prepare('SELECT last_insert_rowid() as id');
    $stmt->execute();
    $id = $stmt->fetch();
    return $id['id'];
  }


  /**
   * Inserts a new story into the database.
   */
  function insertStory($username, $title, $body, $hour) {
    $db = Database::instance()->db();
    $id = entity();
    $stmt = $db->prepare('INSERT INTO stories VALUES(?, ?, ?, ?, ?)');
    $stmt->execute(array(intval($id), $username, $title, $body, $hour));
  }

  function getStoryId($username, $title, $body, $hour){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT entity_id as id FROM stories WHERE username = ? AND title = ? AND body = ? AND hour = ?');
    $stmt->execute(array($username, $title, $body, $hour));
    return $stmt->fetch();
 
  }
  /**
   * Insert theme
   */

   function insertTheme($theme){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO themes VALUES(?)');
    $stmt->execute(array($theme));
   }

   
   /**
    * return user Info
    */
    function getUsernameInfo($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM users where username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
    }

/**
   * Insert theme with storie associated
   */

  function insertEntityTheme($id, $theme){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO entityThemes VALUES(?,?)');
    $stmt->execute(array($id, $theme));
   }

   

  /** 
   * Inserts a new comment
   */

  function insertComment($entity_id, $user_id, $body, $hour){
    $db = Database::instance()->db();
    $id = entity();
    $stmt = $db->prepare('INSERT INTO comments VALUES(?, ?, ?, ?, ?)');
    $stmt->execute(array(intval($id), $entity_id, $user_id, $body, $hour));   
  }

  /**
   * return titile of stories that $username commented
   */
  function myComments($username) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT title FROM stories,comments
     WHERE comments.username = ? 
     AND story_id = stories.entity_id');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }


  /**
   * return stories title of an user
   */
  function myStories($username) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT title FROM stories WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }


  /**
   * Returns a certain story from the database.
   */
  function getStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM stories WHERE entity_id = ?');
    $stmt->execute(array($story_id));
    return $stmt->fetch();
  }

  /**
   * Deletes a certain story.
   */
  function deleteStory($story_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM stories WHERE entity_id = ?');
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
  function getStoryThemes($entity_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT DISTINCT theme FROM entityThemes WHERE entity_id = ?');
    $stmt->execute(array($entity_id));
    return $stmt->fetchAll();
  }

/**
 * return the comments of a story
 */
  function getComments($entity_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM comments where story_id = ? ORDER BY hour DESC');
    $stmt->execute(array($entity_id));
    return $stmt->fetchAll();
  }


  /**
   * return number of up votes
   */

  function numberUpVotes($entity_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM likes where entity_id = ?');
    $stmt->execute(array($entity_id));
    return $stmt->fetch();
  }

  
  /**
   * return number of up votes
   */

  function numberDownVotes($entity_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT COUNT(*) as N FROM dislikes where entity_id = ?');
    $stmt->execute(array($entity_id));
    return $stmt->fetch();
  }

  function addVote($entity_id, $username, $like){
    $db = Database::instance()->db();
    if($like === "true")
      $stmt = $db->prepare('INSERT INTO likes Values(?,?)');  
    else
      $stmt = $db->prepare('INSERT INTO dislikes Values(?,?)');
    $stmt->execute(array($entity_id, $username));
  }

    function deleteVote($entity_id, $username, $like){
      $db = Database::instance()->db();
      if($like === "true")
      $stmt = $db->prepare('DELETE FROM likes where entity_id = ? and username = ?');
      else
      $stmt = $db->prepare('DELETE FROM dislikes where entity_id = ? and username = ?');
      $stmt->execute(array($entity_id, $username));
      }

  
  function votedup($entity_id,$username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM likes where entity_id = ? and username = ?');
    $stmt->execute(array($entity_id, $username));
    return $stmt->fetch()?true:false;
  }

  function voteddown($entity_id,$username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM dislikes where entity_id = ? and username = ?');
    $stmt->execute(array($entity_id, $username));
    return $stmt->fetch()?true:false;
  }

  function getStoriesWiththeme($theme){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT stories.* FROM entityThemes, stories WHERE theme = ? 
    AND entityThemes.entity_id = stories.entity_id');
    $stmt->execute(array($theme));
    return $stmt->fetchAll();
  }

  function getStoriesWithUsername($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM stories WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function getStoriesWithTitle($title){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM stories WHERE title = ?');
    $stmt->execute(array($title));
    return $stmt->fetchAll();
  }

  function themePattern($pattern){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT theme as N FROM themes WHERE theme LIKE ? LIMIT 10');
    $stmt->execute(array("%".$pattern."%"));
    return $stmt->fetchAll();
  }


  function usernamePattern($pattern){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username as N FROM users WHERE username LIKE ? LIMIT 10');
    $stmt->execute(array("%".$pattern."%"));
    return $stmt->fetchAll();
  }

  function storiesPattern($pattern){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT title as N FROM stories WHERE title LIKE ? OR body LIKE ? LIMIT 10');
    $stmt->execute(array("%".$pattern."%", "%".$pattern."%"));
    return $stmt->fetchAll();
  }



?>