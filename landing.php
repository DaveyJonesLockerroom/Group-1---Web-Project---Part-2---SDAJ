<?php
session_start();

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty(trim($_POST['name']))) {
        $error = 'Name is required.';
    } else {
        $_SESSION['username'] = $_POST['name'];
        header('Location: welcome.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Enter your name </title>
        <link rel="stylesheet" href="layout.css">
    </head>

    <body>
        <?php include 'header.php'; ?>

        <section id="main">
            <form action="landing.php" method="POST">
                <h2> Enter your name to continue </h2>
                <input type="text" id="name" name="name" placeholder="Your Name">
            <br>

        <?php 
            if ($error) {
                echo '<p class="error">'.$error.'</p>';
            }
            ?>

        <input type="submit" value="Submit">
        </form>
        </section>

        <?php include 'footer.php'; ?>
    </body>
</html>