
<?php function draw_header($username){
/**
 * Draw the header that is equal in all pages and fixed
 */

?>

  <link rel="stylesheet" href="../css/common.css">
<!DOCTYPE html>
<html>

<head>
    <title> SociStory</title>
    <meta charset="utf-8">
    <meta name="author" content="Carlos Daniel Gomes">
 
    <link rel="stylesheet" href="../css/mainPage.css">
    <!-- if logged in show the account-->
</head>

<body>
    <header>
        <?php if($username != null) { ?>
            <script src="../js/comments.js" defer></script>
            <script src="../js/search.js" defer></script>

           <nav>
           <div class="header">

            <a href="../pages/stories.php?search=all&sub=null" class="logo">SociStory</a>
            <div id="searchArea">
            <form id="searchForm" method="get">
            <select name="searchthemes" id="searchBox">
            <option value="Themes">Themes</option>
            <option value="Users">Users</option>
            <option value="Stories">Stories</option>

            </select>
            <input id="search" type="text" placeholder="Search..">             
            </form>
            <div id="suggestions"></div>
            </div>
                <div class="topnav">
            <a href="../pages/profilePage.php?username=<?=$username?>"> <?=$username?></a>
            <a href="../pages/newStory.php"> + Story </a>
            <a href="../actions/user_logout.php">Logout</a>
            <a href="../pages/stories.php?search=all&sub=null">Home</a>  
                </div>
            </div>


        <?php }  ?>
        </nav>

    </header>


<?php
}
?>

<?php function draw_footer(){

?>
</body>

</html>
<?php
} 
?>
