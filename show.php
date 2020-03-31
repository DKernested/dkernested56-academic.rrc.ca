<!--
Dillon Kernested
Web Dev
Final project Show review page
--->

<?php
  require 'authenticate.php';
  require 'connect.php';

  //get the id from the post and sanatize the variable
  $ReviewId = filter_input(INPUT_GET, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);

  //create statement
  $titleSelect = "SELECT * from reviews WHERE ReviewId = :ReviewId";
  
  //Returns statement object
  $statement = $db->prepare($titleSelect);
  $statement->bindValue('ReviewId', $ReviewId, PDO::PARAM_INT);
  
  //Executes statement 
  $statement->execute();
  $show = $statement->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dillon Kernested - Show Review Post</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">K6 Bookzone - Show Post</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
</ul> <!-- END div id="menu" -->
  <div id="all_reviews">
    <div class="review_post">
        <h2><?= $show['Title'] ?></h2>
        <p>
          <small>
            <?=date("F j, Y, h:i A",strtotime(($show['Date']))) ?>
            <a href="edit.php?id= <?= $id ?>">edit</a>
          </small>
        </p>
        <div class='review_content'>
          <?= $show['Content'] ?>
        </div>
    </div>
  </div>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>