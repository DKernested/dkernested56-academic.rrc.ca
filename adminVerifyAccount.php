<?php

require ('connect.php');
require 'authenticate.php';
session_start();

	//check to make sure title and content are not empty
    if($_POST && (!empty($_POST['username']) && (!empty($_POST['username']) && (!empty($_POST['password']) && (!empty($_POST['repeatPassword']))))))
	{
		//uses connect.php and sanitizes the values.
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repeatPassword = filter_input(INPUT_POST, 'repeatPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //SELECT * FROM `users` WHERE username = 'User01'
        $checkUsername = "SELECT * FROM users WHERE username = :username";
        $searchUsername = $db->prepare($checkUsername);

        $searchUsername->bindValue(':username', $username, PDO::PARAM_STR);
        $searchUsername ->execute();
        $resultUsername = $searchUsername->fetch();
        $countUsername = $searchUsername->rowCount();

        if(!$countUsername == 0)
        {
            $error = "That username is already registered";
        }

        $checkEmail = "SELECT * FROM users WHERE Email = :email";
        $searchEmail = $db->prepare($checkEmail);

        $searchEmail->bindValue(':email', $email);
        $searchEmail ->execute();
        $resultEmail = $searchEmail->fetch();
        $countEmails = $searchEmail->rowCount();

        if($countEmails != 0)
        {
            $error = "That email is already registered";
        }

        elseif($repeatPassword != $password)
        {
            $error = "Password must be identical in both fields.";
        }
        elseif((!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)))
        {
            $error = "the Email entered be a valid Email";
        }
        else
        {
            if(!isset($error))
            {
                $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $statement = $db->prepare($query);
                //bind the values to title and content 
                $statement->bindValue(':username', $username);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':password', $password);
                //execute the statement
                $statement->execute();
            
                header("Location: adminUsersList.php");
                exit;
            }
        }      
    }
    else
    {
        $error = "No fields can be left empty on the register page.";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Post Error</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="adminUsersList.php"></a></h1>
        </div> <!-- END div id="header" -->

	<h1>An error occured while processing your post.</h1>
	<?php if(isset($error)): ?>
  		<p><?= $error ?></p>
	<?php endif; ?>
	<h3><a href="adminUsersList.php">Return to Admin User List</a></h3>
    <h3><a href="adminCreateUser.php">Return to Create User Page</a></h3>

        <div id="footer">
            Dillon Kernested 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>