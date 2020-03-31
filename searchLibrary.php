<?php

require "connect.php";

if(isset($_POST['searchButton']) && isset($_POST['book-search'])) 
{ 
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $bookSearch = $_POST['book-search'];

    $searchQuery = "SELECT * FROM books WHERE OriginalTitle LIKE '%$bookSearch%' OR Author LIKE '%$bookSearch%'";

    $searchStatement = $db->prepare($searchQuery);

    $searchStatement->bindValue(':OriginalTitle', $bookSearch);
    $searchStatement->bindValue(':Author', $bookSearch);

    $searchStatement ->execute();
    $books = $searchStatement->fetchAll();

}


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
            <input type="search" name="book-search" id="book-search">
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