<?php
    require_once('settings.php');
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$conn) {
        echo "<p>Database connection failure</p>";
    }
    else {
        $query = "SELECT * FROM eoi";
        $result = mysqli_query($conn, $query);
        $jobreferencenumber = $_POST["jobreferencenumber"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $dateofbirth = $_POST["dateofbirth"];
    }

?>