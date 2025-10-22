
<!-- 
$create_table_sql = "
            CREATE TABLE IF NOT EXISTS eoi (
                apply_num INT AUTO_INCREMENT PRIMARY KEY,
                reference_number VARCHAR(5) NOT NULL,
                firstname TEXT NOT NULL,
                lastname TEXT NOT NULL,
                dateofbirth DATE NOT NULL,
                gender VARCHAR(10) NOT NULL,
                address VARCHAR(100) NOT NULL,
                suburb VARCHAR(50) NOT NULL,
                state VARCHAR(30) NOT NULL,
                postcode VARCHAR(10) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phonenumber VARCHAR(15) NOT NULL,
                otherskill VARCHAR(100)
            );
        "; -->



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

        
        
        $skills = isset($_POST["skills"]) ? $_POST["skills"] : []; // if more than one it will be an array else empty (is used for check boxes)
        
        
        //$otherskill = sanitise_input($_POST["otherskill"]);

        

        // ensure user filled in all required fields
        $errors = [];
        //if(empty($reference_number)) $errors[] = "Please enter the VALID Job Reference Number.";

        if(!in_array($reference_number, ["LP032", "GD045", "AR058"])) {
            $errors[] = "Please enter a VALID Job Reference Number (e.g. LP032).";
        }

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

        if(empty($skills)) {
                    $skills = []; // Ensure it's an array even if no skills are selected
                }
        //if(empty($skills)) $errors[] =  "Please select at least one Skill";
        // $skills = isset($_POST["skills"]) ? implode(", ", array_map('sanitise_input', $_POST["skills"])) : "";

        if(!empty($errors)) {
            foreach($errors as $error) {//loop through errors array and display each error
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
                echo "<p>Please go back and correct the errors.</p>";
                }
        else {
            
        
            // $insert_sql = "INSERT INTO eoi (reference_number, firstname, lastname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber)
            //    VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber')";        
            $insert_sql = "INSERT INTO eoi (reference_number, firstname, lastname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber)
                VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber')";

            if(mysqli_query($dbcon, $insert_sql)) {
                $apply_num = mysqli_insert_id($dbcon) ; // Get foreign key returns the auto generated apply_num by inserting or updating a table
                $stmt = $dbcon->prepare("INSERT INTO skills (apply_num, cpp, java, python, three_d, two_d, roadmap) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    

                if(!is_array($skills)) {
                    $skills = [$skills]; // Convert to array if it's a single value
                }

                //1 is checked, 0 is not checked
                //in_array to check if skill is in the array of skills selected
                

                //skill1 is the value searching for and $skills is the array to search in                
                $cpp = in_array("cpp", $skills) ? 1 : 0;
                $java = in_array("java", $skills) ? 1 : 0;
                $python = in_array("python", $skills) ? 1 : 0;
                $three_d = in_array("three_d", $skills) ? 1 : 0;
                $two_d = in_array("two_d", $skills) ? 1 : 0;
                $roadmap = in_array("roadmap", $skills) ? 1 : 0;
                


                $insert_skills_sql = "INSERT INTO skills (apply_num, cpp, java, python, three_d, two_d, roadmap)
                                    VALUES ('$apply_num', '$cpp', '$java', '$python', '$three_d', '$two_d', '$roadmap')";

                if(mysqli_query($dbcon, $insert_skills_sql)) { //executes an sql query on the database
                    //$apply_num = mysqli_insert_id($dbcon); // Gets the foreign key

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
                    echo "<p>Phone Number: $phonenumber</p>";
                    
                   
                    echo "<p><strong>Your Skill Selections:</strong></p>";
                    $skill_list = [];
                    if($cpp) {
                        $skill_list[] = "C++";
                        echo "<p>C++</p>";
                    }
                    else {
                        $skill_list[] = "";
                    }

                    if($java) {
                        $skill_list[] = "Java";
                        echo "<p>Java</p>";
                    }
                    else {
                        $skill_list[] = "";
                    }
                    
                    if($python) {
                        $skill_list[] = "Python";
                        echo "<p>Python</p>";
                    }
                    else {
                        $skill_list[] = "";
                    }
                    
                    if($three_d) {
                        $skill_list[] = "3D Modeling";
                        echo "<p>3D Modeling</p>";
                    }
                    else {
                        $skill_list[] = "";
                    }
                   
                    if($two_d) {
                        $skill_list[] = "2D Modeling";
                        echo "<p>2D Modeling</p>";
                    }
                    else {
                        $skill_list[] = "";
                    }
                    
                    if($roadmap) {
                        $skill_list[] = "Roadmap";
                        echo "<p>Roadmap</p>";
                        
                    }
                    else {
                        $skill_list[] = "";
                    }

                }
                
            } 
            else {
                echo "<p>Insertion failed: " . mysqli_error($dbcon) . "</p>";
            }

        
        }


        session_unset();
        session_destroy();
        mysqli_close($dbcon);

    }