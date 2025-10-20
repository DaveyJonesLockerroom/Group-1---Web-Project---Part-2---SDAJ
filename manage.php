<?php
session_start();

require_once ('settings.php');

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
        <?php

            // Redirect if not logged in
            if (!isset($_SESSION['username'])) {
                $_SESSION['error'] = "You must be logged in to access that page.";
                header("Location: login.php");
                exit();
            }

            // Redirect if not an admin
            if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] !== 'Admin') {
                $_SESSION['error'] = "Access denied. Admins only.";
                header("Location: index.php");
                exit();
            }
            if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
                echo '<h1> Welcome to the Management Page, Admin! </h1>';
                echo '<p> Here you can manage the website content and user accounts. </p>';
            }
            else {
                echo '<h1> Access Denied </h1>';
                echo '<p> You do not have permission to access this page. Please log in as an administrator. </p>';
                exit();
            }
        ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Management Page">
    <meta name="keywords" content="manage, admin, control">
    <meta name="author" content="Ari Stein">
    <title>SDAJ Management Page</title>
    <link rel="stylesheet" href="styles/layout.css">
</head>

<body>
    <?php include 'header.inc'; ?>

    <section id="manage-main">


                        <!--  Show All EOI Query  -->

            <form action="manage.php" method="POST" class="admin-form">
                <?php if (!isset($_POST['show_eois'])): ?>
                    <input type="submit" name="show_eois" value="Show All EOI's" class="show_button">
                <?php else: ?>
                    <input type="submit" name="hide_eois" value="Hide EOI's" class="hide_button">
                <?php endif; ?>
            </form>
              <?php
               if(isset($_POST['show_eois'])) {
                $stmt = $conn->prepare("SELECT * FROM eoi");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Index</th><th>EOI Number</th><th>Content</th>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['test_index'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['eoi_number'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['eoi_content'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No entries found.</p>';
                }
            }
           ?>

                     <!-- List EOI's by Job Reference Number: -->

            <form action="manage.php" method="POST" class="admin-form">
                <?php if (!isset($_POST['list_by_ref'])): ?>
                    <input type="submit" name="list_by_ref" value="List EOI's by Job Reference Number" class="show_button">
                <?php else: ?>
                    <input type="submit" name="hide_list_by_ref" value="Hide EOI's by Job Reference Number" class="hide_button">
                <?php endif; ?>
            </form>

            <?php
            if(isset($_POST['list_by_ref'])) {
                $stmt = $conn->prepare("SELECT * FROM eoi ORDER BY eoi_number ASC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Application Number</th><th>Reference Number</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                    <th>Gender</th><th>Address</th><th>Suburb</th><th>State</th><th>Postcode</th><th>Email</th><th>Phone Number</th>
                    <th>Other Skills</th><th>Value</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['apply_num'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['reference_number'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['dateofbirth'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['suburb'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['postcode'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['phonenumber'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['otherskills'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No entries found.</p>';
                }
            }
            ?>


                    <!-- List by First Name -->

            <form action="manage.php" method="POST" class="admin-form">
                <?php if (!isset($_POST['list_by_fname'])): ?>
                    <input type="submit" name="list_by_fname" value="List EOI's by First Name" class="show_button">
                <?php else: ?>
                    <input type="submit" name="hide_list_by_fname" value="Hide EOI's by First Name" class="hide_button">
                <?php endif; ?>
            </form>

            <?php
            if(isset($_POST['list_by_fname'])) {
                $stmt = $conn->prepare("SELECT * FROM eoi ORDER BY eoi_content->>'$.first_name' ASC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Application Number</th><th>Reference Number</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                    <th>Gender</th><th>Address</th><th>Suburb</th><th>State</th><th>Postcode</th><th>Email</th><th>Phone Number</th>
                    <th>Other Skills</th><th>Value</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['apply_num'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['reference_number'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['dateofbirth'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['suburb'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['postcode'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['phonenumber'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['otherskills'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No entries found.</p>';
                }
            }
            ?>

                    <!-- List by Last Name  -->

            <form action="manage.php" method="POST" class="admin-form">
                <?php if (!isset($_POST['list_by_lname'])): ?>
                    <input type="submit" name="list_by_lname" value="List EOI's by Last Name" class="show_button">
                <?php else: ?>
                    <input type="submit" name="hide_list_by_lname" value="Hide EOI's by Last Name" clas="hide_button">
                <?php endif; ?>
            </form>

            <?php
            if(isset($_POST['list_by_lname'])) {
                $stmt = $conn->prepare("SELECT * FROM eoi ORDER BY eoi_content->>'$.last_name' ASC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Application Number</th><th>Reference Number</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                    <th>Gender</th><th>Address</th><th>Suburb</th><th>State</th><th>Postcode</th><th>Email</th><th>Phone Number</th>
                    <th>Other Skills</th><th>Value</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['apply_num'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['reference_number'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['dateofbirth'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['suburb'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['postcode'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['phonenumber'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['otherskills'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No entries found.</p>';
                }
            }
            ?>

                    <!-- List by Full Name  -->

            <form action="manage.php" method="POST" class="admin-form">
                <?php if (!isset($_POST['list_by_fullname'])): ?>
                    <input type="submit" name="list_by_fullname" value="List EOI's by Full Name" class="show_button">
                <?php else: ?>
                    <input type="submit" name="hide_list_by_fullname" value="Hide EOI's by Full Name" class="hide_button">
                <?php endif; ?>
            </form>

            <?php
            if(isset($_POST['list_by_fullname'])) {
                $stmt = $conn->prepare("SELECT * FROM eoi ORDER BY 
                    CONCAT(eoi_content->>'$.first_name', ' ', eoi_content->>'$.last_name') ASC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Application Number</th><th>Reference Number</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                    <th>Gender</th><th>Address</th><th>Suburb</th><th>State</th><th>Postcode</th><th>Email</th><th>Phone Number</th>
                    <th>Other Skills</th><th>Value</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['apply_num'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['reference_number'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['dateofbirth'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['suburb'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['postcode'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['phonenumber'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['otherskills'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No entries found.</p>';
                }
            }
            ?>

                    <!-- Delete EOI by Reference -->
            <form action="manage.php" method="POST" class="admin-form">
                <label for="delete_ref">Enter Reference Number to Delete:</label>
                <input type="text" id="delete_ref" name="delete_ref" required class="admin-textbox" placeholder="EG... LP032">
                <input type="submit" name="delete_eoi" value="Delete EOI" class="delete_button">
            </form>

            <?php
            if (isset($_POST['delete_eoi'])) {
                $delete_ref = trim($_POST['delete_ref']);
                $stmt = $conn->prepare("DELETE FROM eoi WHERE eoi_number = ?");
                $stmt->bind_param("s", $delete_ref);
                if ($stmt->execute()) {
                    echo '<p>EOI with Reference Number ' . htmlspecialchars($delete_ref, ENT_QUOTES, 'UTF-8') . ' deleted successfully.</p>';
                } else {
                    echo '<p>Error deleting EOI.</p>';
                }
            }
            ?>

                    <!-- Change EOI Status -->

            <form action="manage.php" method="POST" class="admin-form">
                <label for="status_ref">Enter Reference Number:</label>
                <input type="text" id="status_ref" name="status_ref" required class="admin-textbox" placeholder="EG... LP032">
                <label for="new_status">New Status:</label>
                <input type="text" id="new_status" name="new_status" required class="admin-textbox" placeholder="EG... Current">
                <input type="submit" name="change_status" value="Change Status" class="update_button">
            </form>

            <?php
            if (isset($_POST['change_status'])) {
                $status_ref = trim($_POST['status_ref']);
                $new_status = trim($_POST['new_status']);
                $stmt = $conn->prepare("UPDATE eoi SET eoi_content = JSON_SET(eoi_content, '$.status', ?) WHERE eoi_number = ?");
                $stmt->bind_param("ss", $new_status, $status_ref);
                if ($stmt->execute()) {
                    echo '<p>Status of EOI with Reference Number ' . htmlspecialchars($status_ref, ENT_QUOTES, 'UTF-8') . ' changed to ' . htmlspecialchars($new_status, ENT_QUOTES, 'UTF-8') . ' successfully.</p>';
                } else {
                    echo '<p>Error changing status.</p>';
                }
            }
            ?>

                    

    </section>

    <?php include 'footer.inc'; ?>
</body>
</html>