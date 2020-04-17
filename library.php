<!--
Dillon Kernested
Web Dev
Final Project View books table
--->

<?php
    
    require 'connect.php'; 
    session_start();

    $ItemsPerPage = 100;
    $TotalRows = 0;
    if (isset($_GET['page'])) {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
    } else {
        $page = 1;
    }
    $StartFromItem = ($page - 1) * $ItemsPerPage;

    //creates the statement in the variable query
    $query = "SELECT * FROM books ORDER BY Title ASC LIMIT $StartFromItem, $ItemsPerPage";

    //returns the statement object
    $statement = $db->prepare($query);

    //executes the statements
    $statement->execute();
    $books = $statement->fetchAll();

    
    $ItemCountQuery = "SELECT COUNT(*) FROM Books";
    $ItemCountStatement = $db->prepare($ItemCountQuery);
    $ItemCountStatement->execute();
    $TotalRows = $ItemCountStatement->fetchAll();

    
    $TotalRows[0]['COUNT(*)'];

    $TotalPages = ceil($TotalRows[0]['COUNT(*)']/$ItemsPerPage);
  
//CSV file recieved on github at https://gist.github.com/jaidevd/23aef12e9bf56c618c41   
?>

<html>
    <head>
    <title>Library of Books</title>
    </head>
    <body>
    <ul id="menu">
          <li><a href="index.php" >Home</a></li>
          <li><a href="library.php" >Library</a></li>
          <li><a href="reviews.php" class='active'>Recent Reviews</a></li>
          <li><a href="create.php" >New Review</a></li>
</ul> <!-- END div ReviewId="menu" -->
<ul>
<li><a href="fiveStarBooks.php">Five Star Books</a>(highest rating)</li>
<li><a href="fourStarBooks.php">Four Star Books</a></li>
<li><a href="threeStarBooks.php">Three Star Books</a></li>
<li><a href="twoStarBooks.php">Two Star Books</a>(lowest rating)</li>
</ul>
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
        <!--
        <div>
        <select name="Category" id="Category">
        <option value="Title">Title</option>
        <option value="Author">Author</option>
        <option value="Date">Year Published</option>
        <option value="ISBN"></option>
        </select>
        </div> -->
        <table class="table is-fullwidth is-hoverable park"> 
            <thead> 
                <tr>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Year published</td>
                    <td>ISBN</td> 
                    </tr>             
        <tr>
        <?php foreach ($books as $book): ?>
            <div class="book">
                    <td><?= $book['Title']?></td>
                    <td><?= $book['Author'] ?></td>
                    <td><?= $book['OriginalPublicationYear']?></td>
                    <td><?=$book['ISBN']?> </td>
                </tr>
        <?php endforeach; ?>
        </table>
        <ul>
			<?php for($i = 1; $i<=$TotalPages; $i++) : ?>
				<li><a href="library.php?page=<?= $i ?>"><?= $i ?></a></li>
			<?php endfor ?>
		</ul>
    </body>
</html>
