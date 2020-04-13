<!--
Dillon Kernested
Web Dev
Final project Show review page
--->

<?php
  require 'authenticate.php';
  require 'connect.php';
  session_start();

  //get the id from the post and sanatize the variable
  $ReviewId = filter_input(INPUT_GET, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);
  $CommentId = filter_input(INPUT_GET, 'CommentId', FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['url'] = "show.php?ReviewId=" . $ReviewId;

  //create statement
  $titleSelect = "SELECT * from reviews WHERE ReviewId = :ReviewId";
  
  //Returns statement object
  $statement = $db->prepare($titleSelect);
  $statement->bindValue('ReviewId', $ReviewId, PDO::PARAM_INT);
  
  //Executes statement 
  $statement->execute();
  $show = $statement->fetch();

  $commentSelect = "SELECT * from comments WHERE ReviewId = :ReviewId";

  $commentStatement = $db->prepare($commentSelect);
  $commentStatement->bindValue('ReviewId', $ReviewId, PDO::PARAM_INT);
  //$commentStatement->bindValue('CommentId', $CommentId, PDO::PARAM_INT);

  $commentStatement->execute();
  $showComments = $commentStatement->fetchAll();

  print_r($CommentId)

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
            <a href="edit.php?ReviewId=<?=$ReviewId ?>">edit</a>
          </small>
        </p>
        <div class='review_content'>
         
          <?= $show['Content'] ?>
            
        </div>
        <p>
          <?php if(!empty($_SESSION['Logged_In'])) :?>
            <a href="createComment.php?ReviewId=<?=$ReviewId?>">Comment</a>
          <?php endif; ?>
        </p>
    </div>
  </div>
  <?php foreach ($showComments as $comments): ?>
  <h3><?=$comments['Username']?></h3>
  <p>
    <small>
      <?=date("F j, Y, h:i A",strtotime(($comments['Date']))) ?>
      <?php if(!empty($_SESSION['admin'])) : ?>
      <a href="editComment.php?CommentId=<?=$comments['CommentId']?>">edit comment</a>
      <?php endif; ?>
    </small>
  </p>
   <?=$comments['Content']?>
  <?php endforeach; ?>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>