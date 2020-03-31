<!--
Dillon Kernested
Web Dev
Assignment Four
--->

<?php
    define('DB_DSN','mysql:host=localhost;dbname=k6 bookzone;charset=utf8');
    define('DB_USER','root');
    define('DB_PASS','');     

    // Create a PDO object called $db.
    $db = new PDO(DB_DSN, DB_USER, DB_PASS); 
?>