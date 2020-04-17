<!--
Dillon Kernested
Web Dev
Final Project Update Delete review page
--->

<?php
	require "connect.php";
	session_start();

	if(empty($_SESSION['Logged_In']))
{
  header("Location: reviews.php");
}
	
	if(isset($_POST['delete'])) 
	{ 
			//Checks for the ReviewId of the post and sanatizes it.
			$ReviewId = filter_input(INPUT_POST, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);

			//creates the query to delete 
			$deleteQuery = "DELETE FROM reviews WHERE ReviewId = :ReviewId LIMIT 1";

			//return the statement 
			$deleteStatement = $db->prepare($deleteQuery);

			//bind the value to the delete statement
			$deleteStatement->bindValue(':ReviewId', $ReviewId, PDO::PARAM_INT);

			//Executes the statement 
			$deleteStatement->execute();
			header("Location: reviews.php");
			exit;	
	}

		
	elseif(isset($_POST['update'])) 
	{ 		
		//if the command is update, checks for values in Title/Content/ReviewId 
		if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['ReviewId']))
		{
			
			//sanitizing the three values 
			$Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			//$Content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$Content = $_POST['Content'];
			$ReviewId = filter_input(INPUT_POST, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);
		//	$BookId = filter_input(INPUT_POST, 'BookId', FILTER_SANITIZE_NUMBER_INT);

		
			//update query statement
			$updateQuery = "UPDATE reviews SET Title = :Title, Content = :Content WHERE ReviewId = :ReviewId";

		
			//returns the update statement object
			$updateStatement = $db->prepare($updateQuery);
			//bind the value to Title, Content, and ReviewId
			$updateStatement->bindValue(':Title', $Title);
			$updateStatement->bindValue(':Content', $Content);
			$updateStatement->bindValue(':ReviewId', $ReviewId, PDO::PARAM_INT);
		//	$updateStatement->bindValue(':BookId', $ReviewId, PDO::PARAM_INT);
			

			//executes the update statement
			$updateStatement->execute();

			header("Location: reviews.php");
			exit;
		}
	}
?>