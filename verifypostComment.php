<!--
Dillon Kernested
Web Dev
Final Project verifypost page verification for reviews
--->

<?php
session_start();
	
	//check to make sure title and content are not empty
	if($_POST && (!empty($_POST['username']) && (!empty($_POST['Content']))))
	{
		//uses connect.php and sanitizes the values.
		require ('connect.php');
		//$Title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$Content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = $_SESSION['username'];
        $Content = $_POST['Content'];
        $ReviewId = filter_input(INPUT_POST, 'ReviewId', FILTER_SANITIZE_NUMBER_INT);

		//insert statement query
		$query = "INSERT INTO comments (username, Content, ReviewId) VALUES (:username, :Content, :ReviewId)";;
		//prepare and return the statment object
		$statement = $db->prepare($query);
		//bind the values to title and content 
		$statement->bindValue(':username', $username);
        $statement->bindValue(':Content', $Content);
        $statement->bindValue(':ReviewId', $ReviewId, PDO::PARAM_INT);
		//execute the statement
		$statement->execute();
			
		header("Location: " . $_SESSION['url']);
		exit;
	}
	else
	{
		//string to display error message 
		$message = "Content must not be empty.";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account Error</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="reviews.php"></a></h1>
        </div> <!-- END div id="header" -->

	<h1>An error occured while processing your post.</h1>
	<?php if(isset($message)): ?>
  		<p><?= $message ?></p>
	<?php endif; ?>
	<a href="review.php">Return to Reviews</a>

        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>