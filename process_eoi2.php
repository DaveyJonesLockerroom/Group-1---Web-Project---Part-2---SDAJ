

<?php
    session_start();
    require_once('settings.php');

    //CREATE EOI table
    $create_table_sql = "CREATE TABLE IF NOT EXISTS eoi (
        apply_num INT AUTO_INCREMENT PRIMARY KEY,
        reference_number ENUM('LP032', 'GD045', 'AR058') NOT NULL,
        firstname TEXT NOT NULL,
        lastname TEXT NOT NULL,
        dateofbirth DATE NOT NULL,
        gender SET('Male', 'Female') NOT NULL,
        address VARCHAR(100) NOT NULL,
        suburb VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        postcode INT(4) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phonenumber BIGINT(15) NOT NULL,
        otherskills VARCHAR(100),
        value ENUM('New', 'Current', 'Final') DEFAULT 'New'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    // Create Skills table
    $create_table_skill = "CREATE TABLE IF NOT EXISTS skills (
        skill_id INT AUTO_INCREMENT PRIMARY KEY,
        apply_num INT NOT NULL,
        cpp TINYINT(1) NOT NULL,
        java TINYINT(1) NOT NULL,
        python TINYINT(1) NOT NULL,
        three_d TINYINT(1) NOT NULL,
        two_d TINYINT(1) NOT NULL,
        roadmap TINYINT(1) NOT NULL,
        FOREIGN KEY (apply_num) REFERENCES eoi(apply_num)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

     // Redirect if not an admin
    if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] !== 'Admin') {
         $_SESSION['error'] = "Admins only. Try the other apply link.";
                 header("Location: jobs.php");
                 exit();
    }

    // this prevents direct access to process_eoi.php without going through index.php 
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.php");
        exit();
        }
   

    echo '<DOCTYPE html>
                    <html lang="en">
                    <head>
                        <title>Apply Now</title >
                        <meta charset="UTF-8">
                        <meta name="eoipage" content="eoi page">
                        <style>
                            
                            body {
                                font-family: Courier New, Courier, monospace;
                                text-align: center;
                                justofy-content: center;
                                margin: 10%;
                                padding: 0;
                                background: linear-gradient(to bottom, #0d0d0d, #1a1a1a);
                                color: #ffcccc;
                                font-size: 1.2em;     
                            }
                            h2 {
                                color:#ff4d4d;
                            }
                            p {
                                font-size: 20px;
                                color: #ffcccc;
                            }
                            a {
                                color: red;
                                text-decoration: none;
                            }
                            a:hover {
                                color: white;
                            }
                            .back_button {
                                font-family: Courier New, Courier, monospace;
                                background-color: red;
                                color: white;
                                padding: 10px 20px;
                                border: solid 1px gold;
                                border-radius: 2px;
                                cursor: pointer;
                            }
                            .back_button:hover {
                                background-color: #ffcccc;
                                color: black;
                            }
                        </style>
                    </head>
                    <body>
                    <div class="container">';

    $dbcon = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$dbcon) {
        echo "<p>Database connection failed: " . mysqli_connect_error() . "</p>";
    }  
    else {
        if(mysqli_query($dbcon, $create_table_sql)) {
            //Created EOI table successfully
        }
        else {
            echo "<p>Error creating EOI table: " . mysqli_error($dbcon) . "</p>";
        }
        if(mysqli_query($dbcon, $create_table_skill)) {
            //Created Skills table successfully
        }
        else {
            echo "<p>Error creating Skills table: " . mysqli_error($dbcon) . "</p>";

        }
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $reference_number = ($_POST["reference_number"]);     
        $firstname = ($_POST["firstname"]);
        $lastname = ($_POST["lastname"]);
        $dateofbirth = ($_POST["dateofbirth"]);  

        //$gender = sanitise_input($_POST["gender"]);
        $gender = isset($_POST["gender"]) ? ($_POST["gender"]) : '';

        $address = ($_POST["address"]);   
        $suburb = ($_POST["suburb"]);    
        $state = ($_POST["state"]);
        $postcode = ($_POST["postcode"]);
        $email = ($_POST["email"]);
        $phonenumber = ($_POST["phonenumber"]); 

        $skills = isset($_POST["skills"]) ? $_POST["skills"] : []; // if more than one it will be an array else empty (is used for check boxes)
        
        $otherskills = isset($_POST["otherskills"]) ? ($_POST["otherskills"]) : ''; //if the fiekd is not set assign empty string

        

        // ensure user filled in all required fields
        $errors = [];
        //if(empty($reference_number)) $errors[] = "Please enter the VALID Job Reference Number.";

        if(!in_array($reference_number, ["LP032", "GD045", "AR058"])) {
            $errors[] = "Please enter a VALID Job Reference Number (e.g. LP032).";
        }

        if(empty($firstname)) $errors[] =  "Please enter your First Name.";
        if(empty($lastname)) $errors[] =  "Please enter your Last Name.";

        // ensure that this is the right format dd/mm/yyyy else error message
        if(!preg_match("/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/", $dateofbirth)) {
            $errors[] = "Please enter your Date of Birth in the correct format (dd-mm-yyyy).";
        }
         else {
            // Converts dd-mm-yyyy to yyyy-mm-dd for MySQL as SQL uses yyyy-mm-dd format
            $date_parts = explode('-', $dateofbirth); //splits this string into an array and sepreates by "-" thus date_parts[0] is dd, date_parts[1] is mm, date_parts[2] is yyyy
            $dateofbirth = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
            }

        if(empty($gender)) $errors[] =  "Please select your Gender.";

        if(!preg_match("/^[^'\"]+$/", $address)) $errors[] =  "Please enter your Street Address."; 
        if(!preg_match("/^[^'\"]+$/", $suburb)) $errors[] =  "Please enter your Suburb."; 
        

        if(empty($state)) $errors[] =  "Please select your State.";

        if(!preg_match("/^\d{4}$/", $postcode)) $errors[] =  "Please enter your Postcode.";

        if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/", $email)) $errors[] =  "Please enter a VALID Email Address.";

        if(!preg_match("/^\d{8,12}$/", $phonenumber)) $errors[] =  "Please enter a VALID Phone Number.";

        if(empty($skills)) {
                    $skills = []; // Ensure it's an array even if no skills are selected
                }
        
        
        if(empty($skills)) $errors[] =  "Please select at least one Skill";
        //$skills = isset($_POST["skills"]) ? implode(", ", array_map('sanitise_input', $_POST["skills"])) : "";

        if(!empty($errors)) {
            foreach($errors as $error) {//loop through errors array and display each error
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
                echo "<p style='color:red;'>Please go back and correct the errors.</p>";
                // https://www.w3schools.com/jsref/met_his_back.asp
                echo '<button type="button" class="back_button" onclick="history.back()">Go Back</button>'; //goesback to the previous page without deleting everything
                }
        
        else {
            
        
            // $insert_sql = "INSERT INTO eoi (reference_number, firstname, lastname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber)
            //    VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber')";        
            $insert_sql = "INSERT INTO eoi (reference_number, firstname, lastname, dateofbirth, gender, address, suburb, state, postcode, email, phonenumber, otherskills)
                VALUES ('$reference_number', '$firstname', '$lastname', '$dateofbirth', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber', '$otherskills')";

            if(mysqli_query($dbcon, $insert_sql)) {
                $apply_num = mysqli_insert_id($dbcon) ; // Get foreign key returns the auto generated apply_num by inserting or updating a table
                 $stmt = $dbcon->prepare("INSERT INTO skills (apply_num, cpp, java, python, three_d, two_d, roadmap) VALUES (?, ?, ?, ?, ?, ?, ?)");
                 
                
                

                if(!is_array($skills)) {
                    $skills = [$skills]; // Convert to array if it's a single value
                }

                //1 is checked, 0 is not checked
                //in_array to check if skill is in the array of skills selected
                

                //skill1 is the value searching for and $skills is the array to search in   
                //https://www.w3schools.com/php/func_array_in_array.asp             
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
                    

                    



                    echo "<h2>Your form is submmitted successfully</h2>";
                    echo "<p>You will recieve an email confirmation shortly.</p>";
                    echo "<p>Your Application ID: $apply_num</p>";
                    echo "Press Here to return to the <a href='index.php'>Home Page</a>.";
           
                    
                   
                    
                }
                
            } 
            else {
                echo "<p>Insertion failed: " . mysqli_error($dbcon) . "</p>";
            }
        }




    }