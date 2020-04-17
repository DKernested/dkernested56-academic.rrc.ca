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
			//Checks for the CommentId of the post and sanatizes it.
			$CommentId = filter_input(INPUT_POST, 'CommentId', FILTER_SANITIZE_NUMBER_INT);

			//creates the query to delete 
			$deleteQuery = "DELETE FROM comments WHERE CommentId = :CommentId LIMIT 1";

			//return the statement 
			$deleteStatement = $db->prepare($deleteQuery);

			//bind the value to the delete statement
			$deleteStatement->bindValue(':CommentId', $CommentId, PDO::PARAM_INT);

			//Executes the statement 
			$deleteStatement->execute();
			header("Location: " . $_SESSION['url']);
			exit;	
	}

		
	elseif(isset($_POST['update'])) 
	{ 		
		//if the command is update, checks for values in Title/Content/CommentId 
		if(isset($_POST['username']) && isset($_POST['Content']) && isset($_POST['CommentId']))
		{
			
			//sanitizing the three values 
			//$Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			//$Content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$Content = $_POST['Content'];
			$CommentId = filter_input(INPUT_POST, 'CommentId', FILTER_SANITIZE_NUMBER_INT);
		//	$BookId = filter_input(INPUT_POST, 'BookId', FILTER_SANITIZE_NUMBER_INT);

		
			//update query statement
			$updateQuery = "UPDATE comments SET Content = :Content WHERE CommentId = :CommentId";

		
			//returns the update statement object
			$updateStatement = $db->prepare($updateQuery);
			//bind the value to Title, Content, and CommentId
			//$updateStatement->bindValue(':Title', $Title);
			$updateStatement->bindValue(':Content', $Content);
			$updateStatement->bindValue(':CommentId', $CommentId, PDO::PARAM_INT);
		//	$updateStatement->bindValue(':BookId', $CommentId, PDO::PARAM_INT);
			

			//executes the update statement
            $updateStatement->execute();

            $selectStatement = "SELECT * FROM comments WHERE CommendId = :CommentId";
            $statement = $db->prepare($selectStatement);
            $statement->bindValue('CommentId', $CommentId, PDO::PARAM_INT);
            
            //Executes statement 
            $statement->execute();
            $show = $statement->fetch();

			header("Location: " . $_SESSION['url']);
			exit;
		}
	}
?>