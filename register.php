<?php
session_start();
require_once ('settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User Registration Page">
    <meta name="keywords" content="register, signup, user">
    <meta name="author" content="Ari Stein">
    <title>SDAJ Registration Page</title>
    <link rel="stylesheet" href="styles/layout.css">
</head>

<body>
    <?php include 'header.inc'; ?>
    <section id="register-main">
        <h1> Register a New Account </h1>
<?php
// Database connection settings

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    // Basic validation
    if (empty($user) || empty($pass)) {
        $error = "Username and password are required.";
    } elseif (strlen($user) < 3  || strlen($user) > 35) {
        $error = "Username must be between 3 and 35 characters.";
    } elseif (strlen($pass) < 4 || strlen($pass) > 255) {
        $error = "Password must be at least 4 characters long.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            // Hash and salt the password
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, password, user_status) VALUES (?, ?, 'User')");
            $stmt->bind_param("ss", $user, $hashed_password);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful! You can now log in.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Error registering user.";
            }
        }
        if (isset($stmt)) {
        $stmt->close();
         }   
    }
}
$conn->close();
?>
        <?php
            if (isset($error)) {
                echo '<div class="error">'.htmlspecialchars($error, ENT_QUOTES, 'UTF-8').'</div>';
            }
        ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
            <br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </section>
    <?php include 'footer.inc'; ?>

</body>
</html>