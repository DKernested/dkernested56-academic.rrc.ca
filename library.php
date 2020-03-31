<!--
Dillon Kernested
Web Dev
Final Project View books table
--->

<?php
    
    require 'connect.php'; 

    //creates the statement in the variable query
    $query = "SELECT * FROM books ORDER BY Title ASC";

    //returns the statement object
    $statement = $db->prepare($query);

    //executes the statements
    $statement->execute();
    $books = $statement->fetchAll();
  
//CSV file recieved on github at https://gist.github.com/jaidevd/23aef12e9bf56c618c41   
?>

<html>
    <head>

    </head>
    <body>
    <ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
</ul> <!-- END div ReviewId="menu" -->
    <form action="searchLibrary.php" method="post">
        <div class="field"> 
            <label class="label">Search for Books by Name or by Author.</label> 
        </div> 
        <div class="field has-addons"> <div class="control is-expanded"> 
            <input type="text" name="book-search" id="book-search">
        <div> 
            <button id="searchButton" name="searchButton" type="submit">Search</button> 
        </div>
        </div> 
        
        <div>
        <table class="table is-fullwidth is-hoverable park"> 
            <thead> 
                <tr>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Year published</td>
                    <td>ISBN</td>
                    <td>Reviews</td>               
        </div>
        <?php foreach ($books as $book): ?>
            <div class="book">
                    <td><?= $book['Title']?></td>
                    <td><?= $book['Author'] ?></td>
                    <td><?= $book['OriginalPublicationYear']?></td>
                    <td><?=$book['ISBN']?> </td>
                    <td><a name="specific-book" href="specificReviews.php?BookId= <?= $books['BookId'] ?>">View Reviews</a></td>
                </tr>
            </div>
        <?php endforeach; ?>
    </body>
</html>
