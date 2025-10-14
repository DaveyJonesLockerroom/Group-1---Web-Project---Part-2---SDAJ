<?php
sessions_start();

require_once ('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";

    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $user['username'];
        
        if ($user['username'] === 'admin') {
            header('Location: manage.php');
        } else {
            header('Location: welcome.php');
        }
    } else {
        $_SESSION['error'] = 'Invalid username or password.';
        header('Location: login.php');
        exit();
    }
}
