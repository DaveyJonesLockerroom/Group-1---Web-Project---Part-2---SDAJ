<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Page">
    <meta name="keywords" content="login, user, authentication">
    <meta name="author" content="Ari Stein">
    <title>SDAJ Login Page</title>
    <link rel="stylesheet" href="styles/layout.css">
</head>

<body>
    <?php include 'header.inc'; ?>

    <section id="login-main">
        <h1> Login to Your Account </h1>
        <?php 
            if (isset($_SESSION['error'])) {
                echo '<div'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }


            // ----- NEED TO USE HASH + SALT FOR LOGIN -----  ALSO NEED TO USE PREPARE STATEMENTS TO SANITISE INPUT ------//
        ?>
        <form action="process_login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </section>

    <?php include 'footer.inc'; ?>
</body>
</html>
