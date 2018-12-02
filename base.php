<?php 

include_once('common.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(header('Location: login.php'));

    header($_SESSION['username']);
    footer();

    ?>