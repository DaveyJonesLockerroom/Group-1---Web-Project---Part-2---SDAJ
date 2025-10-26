<?php
session_start();

$alertMessage = "You have now been logged out.";

session_unset();

session_destroy();

session_start();
$_SESSION['alert'] = $alertMessage;

header("Location: index.php");

exit();

