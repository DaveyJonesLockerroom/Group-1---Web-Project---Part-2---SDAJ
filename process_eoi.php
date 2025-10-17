<?php
    session_start();
    require_once('settings.php');

    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $dbcon = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$dbcon) {
        echo "<p>Database connection failed: " . mysqli_connect_error() . "</p>";
    }  
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $query = "SELECT * FROM eoi";
        $result = mysqli_query($dbcon, $query);

        $reference_number = sanitise_input($_POST["reference_number"]);     
        $firstname = sanitise_input($_POST["firstname"]);
        $lastname = sanitise_input($_POST["lastname"]);
        $dateofbirth = sanitise_input($_POST["dateofbirth"]);  

        $gender = sanitise_input($_POST["gender"]);

        $address = sanitise_input($_POST["address"]);   
        $suburb = sanitise_input($_POST["suburb"]);    
        $state = sanitise_input($_POST["state"]);
        $postcode = sanitise_input($_POST["postcode"]);
        $email = sanitise_input($_POST["email"]);
        $phonenumber = sanitise_input($_POST["phonenumber"]); 

        $skills = isset($_POST['skills']) ? $_POST['skills'] : []; // if more than one it will be an array else empty (is used for check boxes)
        $other_skills = sanitise_input($_POST["other_skills"]);
        
        // ensure user filled in all required fields
        if(empty($reference_number)) {
            echo "<p>Please enter a valid Job Reference Number.</p>";
        }

        if(empty($firstname)) {
            echo "<p>Please enter your First Name.</p>";
        }

        if(empty($lastname)) {
            echo "<p>Please enter your Last Name.</p>";
        }

        if(empty($dateofbirth)) {
            echo "<p>Please enter your Date of Birth.</p>";
        }
        
        if(empty($gender)) {
            echo "<p>Please select your Gender.</p>";
        }

        if(empty($address)) {
            echo "<p>Please enter your Street Address.</p>";
        }

        if(empty($suburb)) {
            echo "<p>Please enter your Suburb.</p>";
        }

        if(empty($state)) {
            echo "<p>Please select your State.</p>";
        }

        if(empty($postcode)) {
            echo "<p>Please enter your Postcode.</p>";
        }

        if(empty($email)) {
            echo "<p>Please enter your Email.</p>";
        }

        if(empty($phonenumber)) {
            echo "<p>Please enter your Phone Number.</p>";
        }



        $sql_table = "eoi";
        $insert = "INSERT INTO $sql_table (reference_number, firstname, firstname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber) 
                   VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber')";        
        
        echo "<h2>Your submitted details are as follows:</h2>";
        //echo "<p>Table: $apply_num</p>";
        echo "<p>Job Reference Number: $reference_number</p>";
        echo "<p>First Name: $firstname</p>";
        echo "<p>Last Name: $lastname</p>";
        echo "<p>Date of Birth: $dateofbirth</p>";
        echo "<p>Gender: $gender</p>";
        echo "<p>Address: $address</p>";
        echo "<p>Suburb: $suburb</p>";
        echo "<p>State: $state</p>";
        echo "<p>Postcode: $postcode</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Phone Number: $phonenumber</p>";



        
        mysqli_close($dbcon);
    }

