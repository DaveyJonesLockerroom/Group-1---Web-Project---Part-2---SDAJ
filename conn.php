<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$db = getenv('DB_NAME');

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {#check the sytanx for this
          echo "<p> Connection to database failed: " . mysqli_connect_error() . "</p>";
}

#Code structure referencing for above: 
#W3Schools. (n.d.). PHP Connect to MySQL. W3Schools.com. https://www.w3schools.com/php/php_mysql_connect.asp --->

