

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
    else if($_SERVER["REQUEST_METHOD"] == "POST") {

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

        
        
        //$skills = isset($_POST["skills"]) ? implode(", ", array_map('sanitise_input', $_POST["skills"])) : ""; // if more than one it will be an array else empty (is used for check boxes)
        $otherskill = sanitise_input($_POST["otherskill"]);

       

        // ensure user filled in all required fields
        $errors = [];
        if(empty($reference_number)) $errors[] = "Please enter the VALID Job Reference Number.";
        if(empty($firstname)) $errors[] =  "Please enter your First Name.";
        if(empty($lastname)) $errors[] =  "Please enter your Last Name.";

        // ensure that this is the right format dd/mm/yyyy else error message
        if(!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$/", $dateofbirth)) $errors[] = "Please enter your Date of Birth in the correct format (dd/mm/yyyy).";

        if(empty($gender)) $errors[] =  "Please select your Gender.";

        if(!preg_match("/[A-Za-z0-9]+/", $address)) $errors[] =  "Please enter your Street Address."; 
        if(!preg_match("/[A-Za-z0-9]+/", $suburb)) $errors[] =  "Please enter your Suburb."; 
        

        if(empty($state)) $errors[] =  "Please select your State.";

        if(!preg_match("/^\d{4}$/", $postcode)) $errors[] =  "Please enter your Postcode.";

        if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/", $email)) $errors[] =  "Please enter a VALID Email Address.";

        if(!preg_match("/^\d{8,12}$/", $phonenumber)) $errors[] =  "Please enter a VALID Phone Number.";

        //if(empty($skills)) $errors[] =  "Please select at least one Skill";

        if(!empty($errors)) {
            foreach($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
                echo "<p>Please go back and correct the errors.</p>";
                }
        else {
            
            
            $insert_sql = "INSERT INTO eoi (reference_number, firstname, lastname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber)
               VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber')";        
            

            if(mysqli_query($dbcon, $insert_sql)) {

                echo "<h2>Your submitted details are as follows:</h2>";
                
                $apply_num = mysqli_insert_id($dbcon);
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
                echo "<p>Phone Number: $phonenumber</p>";
                //echo "<p>Skills: $skills</p>";
                echo "<p>Other Skills: $otherskill</p>";
            } 
            else {
                echo "<p>Insertion failed: " . mysqli_error($dbcon) . "</p>";

            }

        
        }


        
        mysqli_close($dbcon);
    }

