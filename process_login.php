<?php
session_start();

include_once 'env_loader.php';
include_once 'conn.php';

// <!-------------------------------------------------------------------------------------
// ------------------   ADD LOTS OF COMMENTS SO YOU CAN EXPLAIN THE CODE   ---------------
// -------------------------------------------------------------------------------------->

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT username, password, user_status FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->bind_result($db_username, $db_password, $db_user_status);

    if ($stmt->fetch()) {
        if (password_verify($input_password, $db_password )) { //password_verify matches hashes
            $_SESSION['username'] = $db_username;
            $_SESSION['user_status'] = $db_user_status;
            session_regenerate_id(true);
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
