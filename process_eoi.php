<?php
    
    require_once('settings.php');

    $dbcon = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$dbcon) {
        echo "<p>Database connection failure</p>";
    }
    else {
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
        $phone_number = sanitise_input($_POST["phone_number"]); 
        $skills = sanitise_input($_POST["skills"]);   
        
        $sql_table = "eoi";
        $insert = "INSERT INTO $sql_table (reference_number, firstname, firstname, dateofbirth, gender, address, suburb, state, postcode, email, phone_number) 
                   VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phone_number')";        
        
        echo "<h2>Your submitted details are as follows:</h2>";
        echo "<p>Table: $apply_num</p>";
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
        echo "<p>Phone Number: $phone_number</p>";



        $result = mysqli_query($dbcon, $insert);

        if (!$result) {
            echo "<p>Something is wrong with ", $insert, "</p>";
        }
        else {
            echo "<h1>Thank you for your submission</h1>";
            echo "<p>We will be in touch via email or phone if you are shortlisted for an interview.</p>";
        }
        
        mysqli_close($dbcon);
    }

