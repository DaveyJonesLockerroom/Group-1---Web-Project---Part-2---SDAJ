<?php
session_start();

require_once ('settings.php');

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Management Page">
    <meta name="keywords" content="manage, admin, control">
    <meta name="author" content="Ari Stein">
    <title>SDAJ Management Page</title>
    <link rel="stylesheet" href="layout.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section id="manage-main">
        <?php
            if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
                echo '<h1> Welcome to the Management Page, Admin! </h1>';
                echo '<p> Here you can manage the website content and user accounts. </p>';

                // insert queries here 
            } else {
                echo '<h1> Access Denied. You must be an admin to view this page. </h1>';
            }
        ?>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>