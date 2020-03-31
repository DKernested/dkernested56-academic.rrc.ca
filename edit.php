<!--
Dillon Kernested
Web Dev
Final Project Edit review page
--->

<?php
	require 'connect.php';

  //checks if the id has a value and gets the value. 
	if (isset($_GET['ReviewId']))
	{
		$ReviewId = filter_input(INPUT_GET, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);

    //Creates the select statement query
		$selectQuery = "SELECT * from reviews WHERE ReviewId = :ReviewId LIMIT 1";

    //returns the statement object
		$selectStatement = $db->prepare($selectQuery);

    //bind the value of id to the select statement
		$selectStatement->bindValue('ReviewId', $ReviewId, PDO::PARAM_INT);
    
    //executes the statement
		$selectStatement->execute();
		$select = $selectStatement->fetch();
	}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>K6 Bookzone - Edit Post</title>
    <link rel="stylesheet" href="style.css" type="text/css">
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
  <form action="updatedelete.php" method="post">
    <fieldset>
      <legend>Edit Review Post</legend>
      <p>
        <label for="title">Title</label>
        <input name="title" id="title" value="<?= $select['Title'] ?>" />
      </p>
      <p>
        <label for="content">Content</label>
        <textarea name="content" id="content"><?= $select['Content'] ?></textarea>
      </p>
      <p>
        <input type="hidden" name="ReviewId" value="<?= $select['ReviewId'] ?>" />
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
