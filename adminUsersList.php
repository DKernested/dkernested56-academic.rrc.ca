<!--
Dillon Kernested
Web Dev
Final Project View users table [Admin only]
--->

<?php
    
    require 'connect.php'; 
    require 'authenticate.php';
    session_start();

    //creates the statement in the variable query
    $query = "SELECT * FROM users ORDER BY UserId ASC";

    //returns the statement object
    $statement = $db->prepare($query);

    //executes the statements
    $statement->execute();
    $users = $statement->fetchAll();
  
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
    <ul>
        <li><a href="adminCreateUser.php">Create New User</a></li>
    </ul>
        <table class="table is-fullwidth is-hoverable park"> 
            <thead> 
                <tr>
                    <td>User Id</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Role</td> 
                    <td>Edit User</td>
                    </tr>             
        <tr>
        <?php foreach ($users as $user): ?>
            <div class="book">
                    <td><?= $user['UserId']?></td>
                    <td><?= $user['Username'] ?></td>
                    <td><?= $user['Email']?></td>
                    <?php if($user['Role'] == 0) : ?>
                    <td> Admin </td>
                    <?php elseif($user['Role'] == 1) : ?>
                    <td> Regular User </td>
                    <?php endif ?>
                    <td><a href="editUser.php?UserId=<?= $user['UserId']?>">edit</a></td>
                </tr>
        <?php endforeach; ?>
    </body>
</html>
