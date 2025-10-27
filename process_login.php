<?php
session_start();

include_once 'env_loader.php';
include_once 'conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') { // only run login process if the login form was submitted
    $input_username = trim($_POST['username']); // trim removes space from the input
    $input_password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT username, password, user_status FROM users WHERE username = ?"); // prepare statement to prevent SQL injection
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); //will stop the process if prepare fails
    }

    $stmt->bind_param("s", $input_username); // binds the username as a string
    $stmt->execute();
    $stmt->bind_result($db_username, $db_password, $db_user_status); // binds result columns

    if ($stmt->fetch()) {
        if (password_verify($input_password, $db_password )) { //password_verify matches hashes
            $_SESSION['username'] = $db_username;
            $_SESSION['user_status'] = $db_user_status;
            session_regenerate_id(true); //regenerates session id for security purposes
            $stmt->close();
            $conn->close();
            header('Location: ' . ($db_user_status === 'Admin' ? 'manage.php' : 'index.php'));
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header('Location: login.php');
        exit();
    }
}
