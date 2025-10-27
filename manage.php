<?php
session_start();

include_once 'env_loader.php';
include_once 'conn.php';
?>

<!-------------------------------------------------------------------------------------
------------------   ADD LOTS OF COMMENTS SO YOU CAN EXPLAIN THE CODE   ---------------
-------------------------------------------------------------------------------------->

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
        ?>
<html lang="en">
<head>
    <?php include 'inc_files/header.inc'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Management Page">
    <meta name="keywords" content="manage, admin, control">
    <meta name="author" content="Ari Stein">
    <title>SDAJ Management Page</title>
    <link rel="stylesheet" href="styles/layout.css">
</head>

<body>

    <?php include 'inc_files/navbar.inc'; ?>

    <section id="manage-main">
                <?php
                echo '<h1 class="manage-heading"> Welcome to the Management Page, ' 
                . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'). '!</h1>';
                echo '<p class="manage-p"> Here you can manage the website content and user accounts. </p>';
                ?>

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
                  $stmt = $conn->prepare(
                "SELECT 
                e.apply_num,
                e.reference_number,
                e.firstname,
                e.lastname,
                e.dateofbirth,
                e.gender,
                e.address,
                e.suburb,
                e.state,
                e.postcode,
                e.email,
                e.phonenumber,
                e.otherskills,
                e.value,
                CONCAT_WS(', ',
                    CASE WHEN s.cpp = 1 THEN 'C++' END,
                    CASE WHEN s.java = 1 THEN 'Java' END,
                    CASE WHEN s.python = 1 THEN 'Python' END,
                    CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                    CASE WHEN s.two_d = 1 THEN '2D Design' END,
                    CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                    e.otherskills
                ) AS skills_list
                FROM eoi e
                LEFT JOIN skills s ON e.apply_num = s.apply_num
                ");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="manage-table-container">';
                    echo '<table class="manage-table">';
                    echo '<tr>
                        <th class="app-num-col">App Num</th>
                        <th>Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th class="gender-col">Gender</th>
                        <th>Address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Other Skills</th>
                        <th>Value</th>
                        </tr>';
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
                        echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                $stmt = $conn->prepare(
                "SELECT 
                e.apply_num,
                e.reference_number,
                e.firstname,
                e.lastname,
                e.dateofbirth,
                e.gender,
                e.address,
                e.suburb,
                e.state,
                e.postcode,
                e.email,
                e.phonenumber,
                e.otherskills,
                e.value,
                CONCAT_WS(', ',
                    CASE WHEN s.cpp = 1 THEN 'C++' END,
                    CASE WHEN s.java = 1 THEN 'Java' END,
                    CASE WHEN s.python = 1 THEN 'Python' END,
                    CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                    CASE WHEN s.two_d = 1 THEN '2D Design' END,
                    CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                    e.otherskills
                ) AS skills_list
                FROM eoi e
                LEFT JOIN skills s ON e.apply_num = s.apply_num
                ORDER BY e.apply_num Asc
                ");

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="manage-table-container">';
                    echo '<table class="manage-table">';
                    echo '<tr>
                        <th class="app-num-col">App Num</th>
                        <th>Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th class="gender-col">Gender</th>
                        <th>Address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Other Skills</th>
                        <th>Value</th>
                        </tr>';
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
                        echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                $stmt = $conn->prepare(
                "SELECT 
                e.apply_num,
                e.reference_number,
                e.firstname,
                e.lastname,
                e.dateofbirth,
                e.gender,
                e.address,
                e.suburb,
                e.state,
                e.postcode,
                e.email,
                e.phonenumber,
                e.otherskills,
                e.value,
                CONCAT_WS(', ',
                    CASE WHEN s.cpp = 1 THEN 'C++' END,
                    CASE WHEN s.java = 1 THEN 'Java' END,
                    CASE WHEN s.python = 1 THEN 'Python' END,
                    CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                    CASE WHEN s.two_d = 1 THEN '2D Design' END,
                    CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                    e.otherskills
                ) AS skills_list
                FROM eoi e
                LEFT JOIN skills s ON e.apply_num = s.apply_num
                ORDER BY e.firstname Asc
                ");

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="manage-table-container">';
                    echo '<table class="manage-table">';
                    echo '<tr>
                        <th class="app-num-col">App Num</th>
                        <th>Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th class="gender-col">Gender</th>
                        <th>Address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Other Skills</th>
                        <th>Value</th>
                        </tr>';
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
                        echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                    <input type="submit" name="hide_list_by_lname" value="Hide EOI's by Last Name" class="hide_button">
                <?php endif; ?>
            </form>

            <?php
            if(isset($_POST['list_by_lname'])) {
                $stmt = $conn->prepare(
                "SELECT 
                e.apply_num,
                e.reference_number,
                e.firstname,
                e.lastname,
                e.dateofbirth,
                e.gender,
                e.address,
                e.suburb,
                e.state,
                e.postcode,
                e.email,
                e.phonenumber,
                e.otherskills,
                e.value,
                CONCAT_WS(', ',
                    CASE WHEN s.cpp = 1 THEN 'C++' END,
                    CASE WHEN s.java = 1 THEN 'Java' END,
                    CASE WHEN s.python = 1 THEN 'Python' END,
                    CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                    CASE WHEN s.two_d = 1 THEN '2D Design' END,
                    CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                    e.otherskills
                ) AS skills_list
                FROM eoi e
                LEFT JOIN skills s ON e.apply_num = s.apply_num
                ORDER BY e.lastname Asc
                ");

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="manage-table-container">';
                    echo '<table class="manage-table">';
                    echo '<tr>
                        <th class="app-num-col">App Num</th>
                        <th>Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th class="gender-col">Gender</th>
                        <th>Address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Other Skills</th>
                        <th>Value</th>
                        </tr>';
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
                        echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                $stmt = $conn->prepare(
                "SELECT 
                e.apply_num,
                e.reference_number,
                e.firstname,
                e.lastname,
                e.dateofbirth,
                e.gender,
                e.address,
                e.suburb,
                e.state,
                e.postcode,
                e.email,
                e.phonenumber,
                e.otherskills,
                e.value,
                CONCAT_WS(', ',
                    CASE WHEN s.cpp = 1 THEN 'C++' END,
                    CASE WHEN s.java = 1 THEN 'Java' END,
                    CASE WHEN s.python = 1 THEN 'Python' END,
                    CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                    CASE WHEN s.two_d = 1 THEN '2D Design' END,
                    CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                    e.otherskills
                ) AS skills_list
                FROM eoi e
                LEFT JOIN skills s ON e.apply_num = s.apply_num
                ORDER BY CONCAT(e.firstname, ' ', e.lastname) Asc
                ");

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="manage-table-container">';
                    echo '<table class="manage-table">';
                    echo '<tr>
                        <th class="app-num-col">App Num</th>
                        <th>Reference Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th class="gender-col">Gender</th>
                        <th>Address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Other Skills</th>
                        <th>Value</th>
                        </tr>';
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
                        echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
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
                $stmt = $conn->prepare("DELETE FROM skills WHERE apply_num IN (SELECT apply_num FROM eoi WHERE reference_number = ?)");
                $stmt->bind_param("s", $delete_ref);
                $stmt->execute();
                
                $stmt = $conn->prepare("DELETE FROM eoi WHERE reference_number = ?");    
                $stmt->bind_param("s", $delete_ref);

                if ($stmt->execute())
                    {
                    echo '<p>EOI with Reference Number ' . htmlspecialchars($delete_ref, ENT_QUOTES, 'UTF-8') . ' deleted successfully.</p>';
                } else {
                    echo '<p>Error deleting EOI.</p>';
                }
            }
            ?>

                    <!-- Change EOI Status -->

            <form action="manage.php" method="POST" class="admin-form">
                <label for="status_ref">Enter Reference Number:</label>
                <input type="text" id="status_ref" name="status_ref" required class="admin-textbox" placeholder="EG... 1">

                <label for="new_status">New Status:</label>
                <select id="new_status" name="new_status" required class="admin-textbox">
                    <option value="">Select Status</option>
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>

                <input type="submit" name="change_status" value="Change Status" class="update_button">
            </form>

            <?php
            if (isset($_POST['change_status'])) {
                $status_ref = trim($_POST['status_ref']);
                $new_status = trim($_POST['new_status']);
                $stmt = $conn->prepare("UPDATE eoi SET value = ? WHERE apply_num = ?");
                $stmt->bind_param("ss", $new_status, $status_ref);
                if ($stmt->execute()) {
                    echo '<p>Status of EOI with Application Number ' . htmlspecialchars($status_ref, ENT_QUOTES, 'UTF-8') . ' changed to ' . htmlspecialchars($new_status, ENT_QUOTES, 'UTF-8') . ' successfully.</p>';
                } else {
                    echo '<p>Error changing status.</p>';
                }
            }
            ?>



                    <!-- Custom Sort EOI's -->


            <form action="manage.php" method="POST" class="admin-form">
                <label for="sort-field">Enter a field to sort by</label>
                <select id="sort-field" name="sort-field" required class="admin-textbox">
                    <option value="">Select Field</option>
                    <option value="apply_num">Application Number</option>
                    <option value="reference_number">Reference Number</option>
                    <option value="firstname">First Name</option>
                    <option value="lastname">Last Name</option>
                    <option value="dateofbirth">Date of Birth</option>
                    <option value="gender">Gender</option>
                    <option value="suburb">Suburb</option>
                    <option value="state">State</option>
                    <option value="postcode">Postcode</option>
                    <option value="email">Email</option>
                    <option value="phonenumber">Phone Number</option>
                    <option value="value">Status/Value</option>
                </select>
                <input type="submit" name="sort-by-field" value="Sort EOI's" class="show_button">
            </form>
            
            <?php 
            if (isset($_POST['sort-by-field'])) {
                // Specific fields that are allowed in the textbox
                $allowed_fields = [
                    'apply_num','reference_number','firstname','lastname','dateofbirth','gender','address','suburb','state','postcode','email','phonenumber','value'
                ];

                $field = trim($_POST['sort-field']);

                if (!in_array($field,$allowed_fields)) {
                    echo '<p>Invalid field name. Please enter a valid column name.</p>';
                } else {
                    $stmt = $conn->prepare(
                    "SELECT 
                    e.apply_num,
                    e.reference_number,
                    e.firstname,
                    e.lastname,
                    e.dateofbirth,
                    e.gender,
                    e.address,
                    e.suburb,
                    e.state,
                    e.postcode,
                    e.email,
                    e.phonenumber,
                    e.otherskills,
                    e.value,
                    CONCAT_WS(', ',
                        CASE WHEN s.cpp = 1 THEN 'C++' END,
                        CASE WHEN s.java = 1 THEN 'Java' END,
                        CASE WHEN s.python = 1 THEN 'Python' END,
                        CASE WHEN s.three_d = 1 THEN '3D Modelling' END,
                        CASE WHEN s.two_d = 1 THEN '2D Design' END,
                        CASE WHEN s.roadmap = 1 THEN 'Roadmap Planning' END,
                        e.otherskills
                    ) AS skills_list
                    FROM eoi e
                    LEFT JOIN skills s ON e.apply_num = s.apply_num
                    ORDER BY $field Asc
                    ");

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<div class="manage-table-container">';
                        echo '<table class="manage-table">';
                        echo '<tr>
                            <th class="app-num-col">App Num</th>
                            <th>Reference Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th class="gender-col">Gender</th>
                            <th>Address</th>
                            <th>Suburb</th>
                            <th>State</th>
                            <th>Postcode</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Other Skills</th>
                            <th>Value</th>
                            </tr>';
                    }
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
                            echo '<td>' . htmlspecialchars($row['skills_list'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '</tr>';
                        } {
                        echo '</table>';
                        echo '</div>';
                    }
                }
            }
            ?>
    </section>

    <?php include 'inc_files/footer.inc'; ?>
</body>
</html>
