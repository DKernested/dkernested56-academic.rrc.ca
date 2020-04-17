<!--
Dillon Kernested
Web Dev
Final Project Edit comment page
--->

<?php
  require 'connect.php';
  session_start();

  if(empty($_SESSION['Logged_In']))
  {
    header("Location: reviews.php");
  }

  //checks if the id has a value and gets the value. 
	if (isset($_GET['CommentId']))
	{
		$CommentId = filter_input(INPUT_GET, 'CommentId', FILTER_SANITIZE_NUMBER_INT);

    //Creates the select statement query
		$selectQuery = "SELECT * from comments WHERE CommentId = :CommentId LIMIT 1";

    //returns the statement object
		$selectStatement = $db->prepare($selectQuery);

    //bind the value of id to the select statement
		$selectStatement->bindValue('CommentId', $CommentId, PDO::PARAM_INT);
    
    //executes the statement
		$selectStatement->execute();
        $select = $selectStatement->fetch();
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>K6 Bookzone - Edit Post</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/qhzujaa2g0cgw5ckjenolwk13ezyw1t7a9c60zr4kw7eem4k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
      selector: '#content'
    });</script>
  </head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="reviews.php">Review - Edit Review Post</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
</ul> <!-- END div ReviewId="menu" -->
<div id="all_reviews">
  <form action="updatedeleteComment.php" method="post">
    <fieldset>
      <legend>Edit Review Post</legend>
      <p>
        <label for="title">Username</label>
        <input name="username" id="title" value="<?= $select['Username'] ?>" readonly />
      </p>
      <p>
        <label for="content">Content</label>
        <textarea name="Content" id="content"><?= $select['Content'] ?></textarea>
      </p>
      <p>
        <input type="hidden" name="CommentId" value="<?= $select['CommentId'] ?>" />
        <input type="submit" name="update" value="Update" />
        <input type="submit" name="delete" value="Delete"  />
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
