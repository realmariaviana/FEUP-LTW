<?php 
include_once('../templates/common.php');

if(!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

draw_header($_SESSION['username']);
draw_footer();