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
    
    <?php include 'header.inc';

    include 'navbar.inc';

    include 'alert.php'; ?>

    <section id="login-main">
        <h1> Login to Your Account </h1>
        <?php 
            
            if (isset($_SESSION['success'])) {
                echo '<div class="success">' . htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="error">'. htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') .'</div>';
                unset($_SESSION['error']);
            }


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
        <p> Need an account? <a href="register.php">Register here</a>. </p>

    </section>

    <?php include 'footer.inc'; ?>
</body>
</html>
