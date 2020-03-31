<!--
Dillon Kernested
Web Dev
Final Project Reviews page for specific book.
--->

<?php
  require 'authenticate.php';
  require 'connect.php';

  //creates the statement in the variable query
  //$query = "SELECT * FROM reviews WHERE ReviewId = ReviewId ORDER BY date ASC";

  $bookClicked = $_POST['specific-book'];

  $query = "SELECT * FROM books JOIN reviews ON books.bookid = reviews.bookid WHERE book.name LIKE $bookClicked";

  //returns the statement object
  $statement = $db->prepare($query);

  //executes the statements
  $statement->execute();
  $reviews = $statement->fetchAll();
  
?>

<html>
<head>
    <meta charset="utf-8">
    <title>K6 Bookzone - Reviews</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="reviews.php">Recent Reviews</a></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
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
          </div>
        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>