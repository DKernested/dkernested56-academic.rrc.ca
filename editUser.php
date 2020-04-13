<!--
Dillon Kernested
Web Dev
Final Project Edit user page
--->

<?php
    require 'connect.php';
    require 'authenticate.php';

  //checks if the id has a value and gets the value. 
	if (isset($_GET['UserId']))
	{
		$UserId = filter_input(INPUT_GET, 'UserId', FILTER_SANITIZE_NUMBER_INT);

    //Creates the select statement query
		$selectQuery = "SELECT * from users WHERE UserId = :UserId LIMIT 1";

    //returns the statement object
		$selectStatement = $db->prepare($selectQuery);

    //bind the value of id to the select statement
		$selectStatement->bindValue('UserId', $UserId, PDO::PARAM_INT);
    
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
  <form action="updatedeleteUser.php" method="post">
    <fieldset>
      <legend>Edit Review Post</legend>
      <p>
        <label for="title">Username</label>
        <input name="username" id="username" value="<?= $select['Username'] ?>" />
      </p>
      <p>
        <label for="email">Email</label>
        <textarea name="email" id="email"><?= $select['Email'] ?></textarea>
      </p>
      <p>
        <input type="hidden" name="UserId" value="<?= $select['UserId'] ?>" />
        <input type="submit" name="update" value="update" />
        <input type="submit" name="delete" value="delete"  />
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
