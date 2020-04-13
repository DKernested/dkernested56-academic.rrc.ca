<!--
Dillon Kernested
Web Dev
Final Project Update Delete review page
--->

<?php
	require "connect.php";
	
	if(isset($_POST['delete'])) 
	{ 
			//Checks for the ReviewId of the post and sanatizes it.
			$UserId = filter_input(INPUT_POST, 'UserId', FILTER_SANITIZE_NUMBER_INT);

			//creates the query to delete 
			$deleteQuery = "DELETE FROM users WHERE UserId = :UserId LIMIT 1";

			//return the statement 
			$deleteStatement = $db->prepare($deleteQuery);

			//bind the value to the delete statement
			$deleteStatement->bindValue(':UserId', $UserId, PDO::PARAM_INT);

			//Executes the statement 
			$deleteStatement->execute();
			header("Location: adminUsersList.php");
			exit;	
	}

		
	elseif(isset($_POST['update'])) 
	{ 		
		//if the command is update, checks for values in Title/Content/ReviewId 
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['UserId']))
		{
			
			//sanitizing the three values 
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			//$Content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$email = $_POST['email'];
			$UserId = filter_input(INPUT_POST, 'UserId', FILTER_SANITIZE_NUMBER_INT);
		//	$BookId = filter_input(INPUT_POST, 'BookId', FILTER_SANITIZE_NUMBER_INT);

		
			//update query statement
			$updateQuery = "UPDATE users SET username = :username, email = :email WHERE UserId = :UserId";

		
			//returns the update statement object
			$updateStatement = $db->prepare($updateQuery);
			//bind the value to Title, Content, and ReviewId
			$updateStatement->bindValue(':username', $username);
			$updateStatement->bindValue(':email', $email);
			$updateStatement->bindValue(':UserId', $UserId, PDO::PARAM_INT);
			
			//executes the update statement
			$updateStatement->execute();

			header("Location: adminUsersList.php");
			exit;
		}
	}
?>