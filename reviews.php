<!--
Dillon Kernested
Web Dev
Final Project Reviews page
--->

<?php
  session_start();
  require 'connect.php';

  //creates the statement in the variable query
  $query = "SELECT * FROM reviews ORDER BY date DESC LIMIT 10";

  //returns the statement object
  $statement = $db->prepare($query);

  //executes the statements
  $statement->execute();
  $reviews = $statement->fetchAll();

 // print_r($_SESSION['admin']);

/*  if(!empty($_SESSION['Logged_In']))
  {
    $string = "you are logged in";
    print_r($string);
  }*/

  
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
<?php endif; ?>
<?php if(!empty($_SESSION['admin'])) :?>
<li><a href="adminUsersList.php">[Admin]User List</a></li>
<?php endif; ?>
</ul>
    <div id="wrapper">
        <div id="header">
            <h1><a href="reviews.php">Recent Reviews</a></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
          <?php if(!empty($_SESSION['Logged_In'])) :?>
          <li><a href="allReviews.php">List All Reviews</a></li>
          <?php endif ?>
        </ul> <!-- END div id="menu" -->
        <div id="all_reviews">
          <?php foreach ($reviews as $review): ?>
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
          </div>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>