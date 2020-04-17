<?php

require 'connect.php';
session_start();

if(isset($_POST['submit']))
{
   // $userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_NUMBER_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if(isset($username) && isset($password)) 
    {
        $searchQuery = "SELECT * FROM users WHERE Username = '$username'";

        $getUserStatement = $db->prepare($searchQuery);
        $getUserStatement->bindValue('username', $username, PDO::PARAM_STR);
        $getUserStatement->execute();
        $selectUser = $getUserStatement->fetch();
        
        if(isset($selectUser['Password']))
        {
            if(password_verify($password, $selectUser['Password']));
            {
                if($password == $selectUser['Password'])
                {
                    
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $selectUser['UserId'];
                $_SESSION['Logged_In'] = true;

                if($selectUser['Role'] == 0 )
                {
                $_SESSION['admin'] = true;
                }

                header("Location: reviews.php");
                exit;
                }
                elseif($password != $selectUser['Password'])
                {
                    echo "Incorrect Password";
                }
                elseif(!$selectUser)
                {
                    echo "no user found.";
                }
            }
        }
       
    }
}

?>

<html>
<head>
<title>Login</title>
</head>
<body>
<div class="container">
    <form method="post" action="login.php">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="inputField" name="username" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="textbox" id="inputField" name="password" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="submit" id="btnSubmit" />
            </div>
        </div>
    </form>
</div>
</body>
</html>