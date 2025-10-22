<?php 
    session_start();
?>


<!-------------------------------------------------------------------------------------
------------------   ADD LOTS OF COMMENTS SO YOU CAN EXPLAIN THE CODE   ---------------
-------------------------------------------------------------------------------------->


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
    
    <?php include 'inc_files/header.inc';

    include 'inc_files/navbar.inc';

    include 'inc_files/error_alert.inc'; ?>

    <section id="login-main">
        <h1 class="register-heading"> Log in to your account </h1>

        <form action="process_login.php" class="login-form" method="POST">
            <label for="username">Username:</label>
            <input type="text" class="login-textbox" id="username" name="username" placeholder="Username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" class="login-textbox" id="password" name="password" placeholder="Password" required>
            <br>
            <input type="submit" class="login_button" value="Login">
        </form>

        <?php 
            
            if (isset($_SESSION['success'])) {
                echo '<div class="success">' . htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
                unset($_SESSION['success']);
                session_regenerate_id(true);
                $_SESSION['username'] = $user['username'];
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="error">'. htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') .'</div>';
                unset($_SESSION['error']);
            }


        ?> 
        <a href="register.php" class="register-link">Need an account? <span class="highlight-link">Register here</span></a>

    </section>

    <?php include 'inc_files/footer.inc'; ?>
</body>
</html>
