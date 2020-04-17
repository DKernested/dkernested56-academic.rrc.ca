<!--
Dillon Kernested
Web Dev
Final Project Reviews page
--->

<?php
  session_start();
  require 'connect.php';

  //creates the statement in the variable query
  $query = "SELECT * FROM reviews ORDER BY Date DESC";

  //returns the statement object
  $statement = $db->prepare($query);

  //executes the statements
  $statement->execute();
  $reviews = $statement->fetchAll();


  if(isset($_GET['refreshButton'])) 
  {
    $order = $_GET['order'];
 /*   if($order = 'Hot')
    {
        $commentQuery = "SELECT * FROM comments WHERE COUNT(ReviewId) > 3";

        $commentQueryPrep = $db->prepare($commentQuery);
        $commentQueryPrep->execute();
        $commentQueryResult = $commentQueryPrep->fetchAll();

        $orderedQuery = "SELECT * FROM reviews WHERE $commentQueryPrep";
    }
    else
    {*/
    $orderedQuery = "SELECT * FROM reviews ORDER BY $order ASC";
    
    
    $orderStatement = $db->prepare($orderedQuery);

    $orderStatement->bindValue(':order', $order);

    $orderStatement ->execute();
    $orderedReviews = $orderStatement->fetchAll();

  }

  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>K6 Bookzone - Reviews</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<ul>
<?php if(empty($_SESSION['Logged_In'])) :?>
<li><a href="login.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<?php elseif(!empty($_SESSION['Logged_In'])) : ?>
<li><a href="logout.php">Logout</a></li>
<?php endif ?>
</ul>
    <div id="wrapper">
        <div id="header">
            <h1><a href="reviews.php">Recent Reviews</a></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <?php if(!empty($_SESSION['Logged_In'])) :?>
          <li><a href="create.php" >New Review</a></li>
          <li><a href="allReviews.php">List All Reviews</a></li>
          <?php endif ?>
        </ul> <!-- END div id="menu" -->
        <form action="allReviews.php" method="get">
        <div>
        <select name="order" id="order">
        <p>Select Order of List</p>
        <option value="Title">Order By Title</option>
        <option value="Date">Order By Date Created</option>
        <option value="Content">Order By Content</option>
       <!-- <option value="Hot">Order By Hot</option>-->
        </select>
        <div> 
            <button id="refreshButton" name="refreshButton" type="submit">Refresh List</button> 
        </div>
        <div id="all_reviews">
            <?php if(!isset($_GET['refreshButton'])) :?>
          <?php foreach ($reviews as $review): ?>
          <div class="review_post">
            <h2><a href="show.php?ReviewId=<?= $review['ReviewId']?>"><?= $review['Title'] ?></a></h2>
            <p>
              <small>
                <?=date("F j, Y, h:i A",strtotime(($review['Date']))) ?>
                <?php if(!empty($_SESSION['Logged_In'])) :?>
                <a href="edit.php?ReviewId=<?= $review['ReviewId']?>">edit</a>
                <?php endif ?>
              </small>
            </p>
            <?php if(strlen($review['Content'])<201):?>
              <div class='review_content'>
               <?= $review['Content'] ?> <a href="show.php?ReviewId=<?= $review['ReviewId']?>">Read Comments</a>
              </div> 
            <?php endif; ?>
            <?php if(strlen($review['Content'])>200) :?>
             <div class='review_content'>
               <?= substr($review['Content'], 0,200)  ?> <a href="show.php?ReviewId=<?= $review['ReviewId']?>">Read All</a>
              </div>
            <?php endif; ?>
            </div>
            <?php if(!empty($_SESSION['Logged_In'])) :?>
              <a href="createComment.php?ReviewId= <?= $review['ReviewId'] ?>">Comment</a>
              <?php endif ?>
            <?php endforeach; ?>
            <?php endif; ?>

            <?php if(isset($_GET['refreshButton'])) :?>
          <?php foreach ($orderedReviews as $review): ?>
          <div class="review_post">
            <h2><a href="show.php?ReviewId=<?= $review['ReviewId']?>"><?= $review['Title'] ?></a></h2>
            <p>
              <small>
                <?=date("F j, Y, h:i A",strtotime(($review['Date']))) ?>
                <a href="edit.php?ReviewId=<?= $review['ReviewId']?>">edit</a>
              </small>
            </p>
            <?php if(strlen($review['Content'])<201):?>
              <div class='review_content'>
               <?= $review['Content'] ?> 
              </div>
            <?php endif; ?>
            <?php if(strlen($review['Content'])>200) :?>
             <div class='review_content'>
               <?= substr($review['Content'], 0,200)  ?> <a href="show.php?ReviewId=<?= $review['ReviewId']?>">Read More</a>
              </div>
            <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </form>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>