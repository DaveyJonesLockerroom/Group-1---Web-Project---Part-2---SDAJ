<?php 
session_start();
include_once __DIR__ .'/env.loader.php';

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$db = getenv('DB_NAME');

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {#check the sytanx for this
          echo "<p> Connection to database failed: " . mysqli_connect_error() . "</p>";
}
?>

<!--Code structure referencing for above: 
W3Schools. (n.d.). PHP Connect to MySQL. W3Schools.com. https://www.w3schools.com/php/php_mysql_connect.asp --->


<!DOCTYPE html>

<html lang="en">

<head>
    <?php include 'header.inc'; ?>
        <style>
            .top_page { 
                /* reference https://deepai.org/machine-learning-model/text2img */
                background-image: url('images/dark_fantasy_image.jpg');
                background-repeat: no-repeat;
                background-size: cover;  
            }
        </style>
</head>

<body>
    
    <!-- The navigation bar and logo -->
    <?php include 'navbar.inc'; ?>
    
    <!-- The image and aplliance option -->
     <section class="top_page">

        <div class="content">
            <h2 style="color: white; font-size: 1.4em;">Find Your Future Here!</h2>
        
            <a href="#moreinfo" class="info">Apply Now</a>

        </div>

        
     </section>


    <!-- Information section  -->
     <div class="swords" aria-labelledby="moreinfo">
        
     <header id="moreinfo">    
        <h1>Begin Your Journey With Us</h1>
        <p>Before you begin click <a href="jobs.php" target="_blank"><strong>HERE</strong></a> to find out the right roles for you.</p>    
    </header>
    
    
    <br>


    
    <form action="process_eoi.php" method="post" id="form">
        
        <!--Job Reference Number-->
        <div class="form-textinput">
        <label for="reference_number">Job Reference Number:</label>
        <input type="text" pattern="[A-Za-z0-9]{5}" id="reference_number" name="reference_number" maxlength="5" placeholder="e.g. AB123" required>
        </div>

        <!--First and last name-->
        <div class="form-textinput">
            <label for="firstname">First Name:</label>
            <input type="text" pattern="[A-Za-z]+" name= "firstname" id="firstname" placeholder="First Name" maxlength ="20" size="20" required >
            <label for="lastname">Last Name:</label>
            <input type="text" pattern="[A-Za-z]+" name="lastname" id="lastname" placeholder="Last Name" maxlength ="20" size="20" required>
            
        </div>

        <!--Birthday-->
        <div class="form-textinput">
            <label for="dateofbirth">Date of Birth</label>
            <input type="text" name= "dateofbirth" id="dateofbirth" pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}" placeholder="dd/mm/yyyy" required>
        </div>

        <!--Gender-->
        <fieldset class="form-gender">
            <legend>Gender</legend>
                <label>
                <input type="radio" name="gender" id="male" >Male
                </label>

                <label>
                <input type="radio" name="gender" id="female" >Female
                </label>
        </fieldset>

        <!--Address-->
        <div class="form-textinput">
            <label for="address">Street Address</label>
            <input type="text" pattern="[A-Za-z0-9]+" id="address" name="address" maxlength="40" size="40" required>
            <br>
            <label for="suburb">Suburb</label>
            <input type="text" pattern="[A-Za-z0-9]+" id="suburb" name="suburb" maxlength="40" size="40" required>
            <br>
            <label for="state">State</label>
            <select name="state" id="state" required>
                <option value="">Please Select State</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
                <option value="OTHER">OTHER</option>
            </select>
        
            <label for="postcode">Postcode</label>
            <input type="text" pattern="\d{4}" name="postcode" id="postcode" maxlength="4" required>
        </div>

        <!--Email-->
        <div class="form-textinput">
            <label for="email">Email</label>
            <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" id="email" required>
        </div>

        <!--Phone Number-->
        <div class="form-textinput">
            <label for="phonenumber">Phone Number</label>
            <input type="text" pattern="\d{8,12}" name="phonenumber" id="phonenumber" minlength="8" maxlength="12" required>
        </div>

        <!--List of Skills-->
        <div class="form-skills">
            <h3 style="color: red;">Select the set of Skills you understand</h3>
        <div class="skills-selection">

            <label for="skill1"><input type="checkbox" id="skill1" name="C++/C#">C++/C#</label>
            
            <label for="skill2"><input type="checkbox" id="skill2" name="Java">Java</label>
            
            <label for="skill3"><input type="checkbox" id="skill3" name="Python">Python</label>
            
            <label for="skill4"><input type="checkbox" id="skill4" name="3D Model">3D Model</label>
            
            <label for="skill5"><input type="checkbox" id="skill5" name="2D Model">2D Model</label>
            
            <label for="skill6"><input type="checkbox" id="skill6" name="Roadmap">Roadmap</label>
            
            
           
        </div>
        <div class="otherskills">
            <label for="otherskill" style="color: red;">Other Skills</label>
            <br>
            <textarea name="writetext" id="otherskill" rows="5" cols="100" placeholder="If you selected Other for your state please enter the state that you are in HERE, along with your other skills."></textarea>
        </div>
            
        </div>


        <!-- https://www.w3schools.com/tags/att_input_type_file.asp  -->
        <div class="resume">
            <label for="fileInput">Resume</label>
            <br>
            <input type="file" id="fileInput" name="myFile">
        </div>
        
        

        <div class="buttons">
            <input type= "submit" value="Book" class="submit">
	        <input type= "reset" value="Reset Form" class="reset">
        </div>
        

        

    </form>
   
    </div>
    
    <!-- Footer -->
    <?php include 'footer.inc'; ?>

</body>
</html>