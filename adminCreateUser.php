<?php
    require 'connect.php';
    require 'authenticate.php';
    session_start();

    if(empty($_SESSION['Logged_In']))
    {
    header("Location: reviews.php");
    }
?>

<html>
<head>
<title>Register</title>
</head>
<body>
<div class="container">
    <form method="post" action="adminVerifyAccount.php">
        <div id="div_login">
            <h1>Create User</h1>
            <div>
                <h3>Username</h3>
                <input type="text" class="textbox" id="inputField" name="username" placeholder="Username" />
            </div>
            <div>
                <h3>Email</h3>
                <input type="text" class="textbox" id="inputField" name="email" placeholder="Email" />
            </div>
            <div>
                <h3>Password</h3>
                <input type="password" class="textbox" id="inputField" name="password" placeholder="Password"/>
            </div>
            <div>
                <h3>Re-Enter Password</h3>
                <input type="password" class="textbox" id="inputField" name="repeatPassword" placeholder="Password"/>
            </div>
            <div>
                <h4>Create Account!</h4>
                <input type="submit" value="Submit" name="submit" id="btnSubmit" />
            </div>
        </div>
    </form>
</div>
</body>
</html>