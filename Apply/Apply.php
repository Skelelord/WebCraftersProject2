
<!DOCTYPE html>
<html lang="en" title="Apply Page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8" />
  <meta name="description" content="Apply for job" />
  <meta name="keywords" content="HTML5, CSS layout" />
  <meta name="author" content="Christopher"  />
  <title>CSS Layout</title>
  <!-- References to external CSS files -->
 <!--<link rel = "stylesheet" type = "text/CSS" href = "/../CSS/ApplyPage.css"></link>--> 
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/ApplyPage.css">
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/Main.css">

<body>
    <?php include '../include/header_main.inc'; ?>

    <main>
        <?php 
            session_start();
            // if (session_status() === PHP_SESSION_NONE) {
            //     $_SESSION['posted'] = false;
                
            // }
            if (isset($_SESSION['posted']))
            {
                echo "<h2>Posting<h2>";
                // Page 2
                        
                echo $_SESSION['username']; // Outputs: John Doe
            }

        ?>
        <div  id = "belowheader">
            <h1>Apply With <span class = "colorchange">Us</span></h1>
            <p><em>"We are a great company to work for."</em></p>
        </div>
        
        <div class = "ExpressionOfInterest">
            <h2>Expression of Interest</h2>
            <form>
                <input></input>
            </form>
        </div>
        <h2>Application form:</h2>
        <div class = "parent_div" id = "formDiv">
        <form action = "Process_eoi.php" method="post">
            <fieldset>
                <lable for = "status">Status</lable>
                <select for = "status">
                    <option value="New" selected>New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
            <br>
            </select>
            </fieldset>
            <section id = "nav">
            <label for = "jobReferenceNumber">Job reference number:</label>
            <input id = "jobReferenceNumber" name = "jobReferenceNumber" type = "text">

            <p id = "ww" style = "color: red">hwefes</p>
            <?php
                if (!empty($_SESSION['jobReferenceNumber']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "firstName">First name:</label>
            <input id = "firstName" name = "firstName" type = "text">
            <?php
                if (!empty($_SESSION['firstName']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>
            <label for = "lastName">Last name:</label>
            <input id = "lastName" name = "lastName" type = "text">
            <?php
                if (!empty($_SESSION['lastName']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "DOB">Date of birth:</label>
            <input id = "DOB" name = "DOB" type = "date">
            <?php
                if (!empty($_SESSION['dateOfBirth']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>
            
            <fieldset>
                <legend>Gender:</legend>
                <input type="radio" name="gender" value="gender">
                <label>Male</label>
                <input type="radio" name="gender" value="gender">
                <label>Female</label>
                <input type="radio" name="gender" value="gender">
                <label>Other</label>
                <?php
                    if (!empty($_SESSION['gender']))
                    {
                    //   echo "<p>working</p>";
                    }
                    else {
                        echo "<p id = 'warning'>this entry is required</p>";
                    }
                ?>
            </fieldset>
            <br>

            <label for = "streetAddress">Street Address:</label>
            <input id = "streetAddress" name = "streetAddress" type = "text">
            <?php
                if (!empty($_SESSION['streetAddress']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "suburbAndTown">Suburb/Town:</label>
            <input id = "suburbAndTown" name = "suburbAndTown" type = "text">
            <?php
                if (!empty($_SESSION['suburbAndTown']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "state">State:</label>
            <select id = "state" name = "state">
                <option value="" disabled selected>Please choose an option</option>
                <option value="Victoria">VIC</option>
                <option value="NewSouthWales">NSW</option>
                <option value="Tasmania">TAS</option>
                <option value="SouthAustralia">SA</option>
                <option value="WesternAustralia">WA</option>
                <option value="Canberra">ACT</option>
                <option value="Queensland">QLD</option>
                <option value="NorthernTerritory">NT</option>
            <?php
                if (!empty($_SESSION['state']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            </select>
            <br>

            <label for = "postcode">Postcode:</label>
            <input id = "postcode" name = "postcode" type = "text">
            <?php
                if (!empty($_SESSION['postcode']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "email">Email:</label>
            <input id = "email" name = "email" type = "email">
            <?php
                if (!empty($_SESSION['email']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>

            <label for = "phoneNumber">Phone number:</label>
            <input id = "phoneNumber" name = "phoneNumber" type = "text">
            <?php
                if (!empty($_SESSION['phoneNumber']))
                {
                 //   echo "<p>working</p>";
                }
                else {
                    echo "<p id = 'warning'>this entry is required</p>";
                }
            ?>
            <br>
            <fieldset>
                <legend>Skills list:</legend>
                <br>
                <input type="checkbox" id = "communication" name="communication" value="communication">
                <label>Communication</label>
                <input type="checkbox" id = "css" name="css" value="css">
                <label>CSS</label>
                <input type="checkbox" id = "javascript" name="javascript" value="javascript">
                <label>javascript</label>
                <input type="checkbox" id = "php" name="php" value="php">
                <label>PHP</label>
                <input type="checkbox" id = "my_sql" name="my_sql" value="my_sql">
                <label>MySQL</label>
            </fieldset>
            <br>

            <label for = "otherSkills">Other Skills:</label>
            <textarea id = "otherSkills" name = "otherSkills" rows = "4" cols = "30"></textarea>
            <br>

            <input id = "submitButton" type = "submit" value = "submit">
            <input id = "resetButton" type = "reset" value = "reset">
            </section>
        </form>
        </div>
    </main>
    
     <?php include '../include/footer.inc'; ?>
