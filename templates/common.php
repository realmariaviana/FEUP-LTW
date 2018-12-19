
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
            <script id="commentScript" src="../js/comments.js" defer></script>
            <script src="../js/search.js" defer></script>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
           <nav>
           <div class="header">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           
           <div class="topnav" id="myTopnav">

               <div class="logo">
                   <a href="../pages/stories.php?search=all&sub=null" class="logo">SociStory</a>
               </div>

               <div class="searchArea">
                    <div class="form-area">
                        <form id="searchForm" method="get">
                            <select name="searchthemes" id="searchBox">
                                <option value="Themes">Themes</option>
                                <option value="Users">Users</option>
                                <option value="Stories">Stories</option>
                            </select>
                            <input id="search" type="text" placeholder="Search..">             
                        </form>
                    </div>
                        <div id="suggestions"></div>
               </div>

               <div class=topnav-right>
               
                   <a href="../pages/stories.php?search=all&sub=null">Home</a>  
                   <a href="../pages/profilePage.php?username=<?=$username?>"> <?=$username?></a>
                   <a href="../actions/user_logout.php">Logout</a>
                   
               <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                   <i class="fa fa-bars"></i>
               </a>
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
