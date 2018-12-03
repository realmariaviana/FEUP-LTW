<?php 
include_once('../templates/common.php');
include_once('../includes/session.php');


if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

draw_header($_SESSION['username']);
draw_footer();