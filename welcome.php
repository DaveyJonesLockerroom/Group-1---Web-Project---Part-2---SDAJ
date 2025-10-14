<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome Page">
    <meta name="keywords" content="welcome, user, home">
    <meta name="author" content="Ari Stein">
    <title>Welcome to SDAJ</title>
    <link rel="stylesheet" href="layout.css">

</head>
<body>
    <?php include 'header.php'; ?>

    <section id="welcome-main">
        <h1> Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! </h1>
        <p> You have successfully logged in. Enjoy your stay at SDAJ! </p>
    </section>

    <?php include 'footer.php'; ?>

    <?php 
    session_unset();
    session_destroy();
    ?>



</body>
</html>