<?php
session_start();

include_once 'env_loader.php';
include_once 'conn.php';

$alertMessage = "You have now been logged out.";

session_unset();

session_destroy();

mysqli_close($conn);

session_start();
$_SESSION['alert'] = $alertMessage;

header("Location: index.php");

exit();

