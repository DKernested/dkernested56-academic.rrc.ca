<?php
//use pseudo for user login
//$_SESSION['user'] = userid

require "connect.php";
session_start();
/*
$ItemsPerPage = 8;
    $TotalRows = 0;
    if (isset($_GET['page'])) {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
    } else {
        $page = 1;
    }
    $StartFromItem = ($page - 1) * $ItemsPerPage;
*/
        
/*    
$bookSearch = filter_input(INPUT_POST, 'book-search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $searchQuery = "SELECT * FROM books WHERE OriginalTitle LIKE '%$bookSearch%' OR Author LIKE '%$bookSearch%' LIMIT $StartFromItem, $ItemsPerPage";
    //LIMIT $StartFromItem, $ItemsPerPage
    $searchStatement = $db->prepare($searchQuery);

    $searchStatement->bindValue(':OriginalTitle', $bookSearch);
    $searchStatement->bindValue(':Author', $bookSearch);

    $searchStatement ->execute();
    $books = $searchStatement->fetchAll();

    $ItemCountQuery = "SELECT COUNT(*) FROM Books WHERE OriginalTitle LIKE %$bookSearch% OR Author LIKE %$bookSearch% ";
    $ItemCountStatement = $db->prepare($ItemCountQuery);
    $ItemCountStatement->execute();
    $TotalRows = $ItemCountStatement->fetchAll();

    
   // $TotalRows[1]['COUNT(*)'];

    $TotalPages = ceil($TotalRows[1]['COUNT(*)']/$ItemsPerPage);

*/
if(empty($_POST['book-search']) || isset($_POST['book-search'])) 
{ 
    
    $limit = $_POST['limit'];   

    //$bookSearch = $_POST['book-search'];
    $bookSearch = filter_input(INPUT_POST, 'book-search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $searchQuery = "SELECT * FROM books WHERE OriginalTitle LIKE '%$bookSearch%' OR Author LIKE '%$bookSearch%' $limit";
    //LIMIT $StartFromItem, $ItemsPerPage

    $searchStatement = $db->prepare($searchQuery);

    $searchStatement->bindValue(':OriginalTitle', $bookSearch);
    $searchStatement->bindValue(':Author', $bookSearch);

    $searchStatement ->execute();
    $books = $searchStatement->fetchAll();


   // print_r($books);
  //  print_r($searchQuery);
   // print_r($searchStatement);
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Searched Library Page</title>
    </head>
    <body>
    <h1><?=print_r($TotalRows);?></h1>
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
        </div>
    
        <div>
        <select name="limit" id="limit">
        <option value="">-select search limit-</option>
        <option value="LIMIT 5">5</option>
        <option value="LIMIT 10">10</option>
        <option value="LIMIT 25">25</option>
        <option value="LIMIT 50">50</option>
        </select> 
        </div> 
        <table class="table is-fullwidth is-hoverable park"> 
            <thead> 
                <tr>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Year published</td>
                    <td>ISBN</td>  
                </tr>
                             
        <?php foreach ($books as $book): ?>
            <tr>
                    <td><?= $book['Title']?></td>
                    <td><?= $book['Author'] ?></td>
                    <td><?= $book['OriginalPublicationYear']?></td>
                    <td><?=$book['ISBN']?> </td>
                </tr>
        <?php endforeach; ?>
        </table>
          <ul>
			<?php for($i = 1; $i<=$TotalPages; $i++) : ?>
				<li><a href="searchLibrary.php?page=<?= $i ?>"><?= $i ?></a></li>
			<?php endfor ?>
		</ul>
        </form>
    </body>
</html>