<!--
Dillon Kernested
Web Dev
Final Project create review page
--->

<?php
session_start();

if(empty($_SESSION['Logged_In']))
{
  header("Location: reviews.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dillon Kernested - New Post</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/qhzujaa2g0cgw5ckjenolwk13ezyw1t7a9c60zr4kw7eem4k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
      selector: '#content'
    });</script>
</head>
<body>
<ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
        </ul> <!-- END div id="menu" -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">K6 Bookzone - New Review</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" >Home</a></li>
    <li><a href="reviews.php" class='active'>Reviews</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_blogs">
  <form action="verifypost.php" method="post">
    <fieldset>
      <legend>New Review</legend>
      <p>
        <label for="Title">Book Title</label>
        <input name="Title" id="title" />
      </p>
      <p>
        <label for="Content">Content</label>
        <textarea name="Content" id="content"></textarea>
      </p>
      <p>
        <input type="submit" name="command" value="Create" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
