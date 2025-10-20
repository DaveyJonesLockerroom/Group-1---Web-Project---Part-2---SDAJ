<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pwd = getenv('DB_PASSWORD');
$sql_db = getenv('DB_NAME');

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
          error_log("Database connection failed: " . mysqli_connect_error());
          echo "<p> Connection to database failed: Please try again later. </p>";
          exit;
}
?>

<!--Code structure referencing for above: 
W3Schools. (n.d.). PHP Connect to MySQL. W3Schools.com. https://www.w3schools.com/php/php_mysql_connect.asp --->

