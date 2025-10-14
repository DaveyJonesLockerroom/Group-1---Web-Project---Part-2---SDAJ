<?php
session_start();

require_once ('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}

// ----- NEED TO USE HASH + SALT FOR LOGIN -----  ALSO NEED TO USE PREPARE STATEMENTS TO SANITISE INPUT ------//

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    if (password_verify($input_password, $hashed)) {
        // Password is correct
    } else {
        // Invalid password
    }

    $stmt = $conn->prepare("SELECt username, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($input_password, $user['password_hash'])) {
        $_SESSION['username'] = $user['username'];
        header('Location: ' . ($user[username] === 'admin' ? 'manage.php' : 'index.php'));
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header('Location: login.php');
        exit();
    }

}
