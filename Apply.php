
<?php
    //checks whether the given symbol is inside the passed through word
    function CheckForSymbol($symbol, $text)
    {
        $characterList = str_split($text);
        $index = 0;
        while ($index < count($characterList))
        {
            //check for symbol
            if ($characterList[$index] == $symbol)
            {
                return TRUE; //Symbol exists
            }
            $index += 1; //increment the index
        }
        return FALSE;
    }
    //Check for an integer in the passed through text
    function CheckIfInteger($text)
    {
        $characterList = str_split($text);
        $index = 0;
        while ($index < count($characterList))
        {
            //check for symbol
            if (is_numeric($characterList[$index]))
            {
                return TRUE; //integer exists
            }
            $index += 1; //increment the index
        }
        return FALSE; //Integer does not exist
    }

    //Checks the passed through string for any special characters
    function CheckForSpecialCharacters($text)
    {
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $text))
        {
            return TRUE; //Special Characters exist
        }
        return FALSE; //Special Characters do not exit
    }

?>
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
<link rel = "stylesheet" type = "text/CSS" href = "CSS/Main.css">


<body id = "apply">
    <?php include 'include/header_main.inc'; 
        if (session_start() === PHP_SESSION_NONE)
        {
            //No session active, create new
            session_start();
        }
        require_once("settings.php");
        //establish connection to the database
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    ?>

    <main id = "apply">
        <?php 
            $postSuccesfull = TRUE;
            $previouslyPosted = False; //Checks wether posted from 'proccess_eoi.php'
            if (isset($_SESSION['posted']))
            {
                //Check if we have just posted data from the Proccess_eoi page
                if ($_SESSION['posted'] == True)
                {
                    //reset for next time e.g. if leave the page and come back to it later on
                    $_SESSION['posted'] = False;
                    $previouslyPosted = True;
                }
                else //come to the page from somewhere else
                { //or refreshed
                    session_unset(); 
                }
            }
            else
            {
                session_unset(); 
            }

        ?>
        <!-- This is a div containing heading and basic description -->
        <div  id = "belowheader">
            <div id = "working">
                <h1 id = "apply">Apply With <span class = "colorchange">Us</span></h1>
                <p><em>"We are a great company to work for."</em></p>
                <!--<h6 class = "glow">Glowing Text</h6> -->
            </div>
        </div>

        <!-- This is a fairly ok heading -->
        <h2>Application form:</h2>

        <!-- This is a form which will post the data sent the server -->
        <div id = "apply-formDiv">

            <div id = "apply-ani">
            <form action = "Process_eoi.php" method="post">
                <fieldset class = "apply">
                    <!-- Identify the formstate -->
                    <lable for = "formState">Status</lable>
                    <select id = "formState" name = "formState">
                        <option value="new" selected>New</option>
                        <option value="current">Current</option>
                        <option value="final">Final</option>
                <br>
                </select>
                </fieldset>
                <section id = "apply-nav">
                <label for = "jobReferenceNumber">Job reference number:</label>
                <input id="jobReferenceNumber" name="jobReferenceNumber" type="text" value="<?php echo isset($_GET['ref']) ? htmlspecialchars($_GET['ref']) : ''; ?>">
                <!-- <input id = "jobReferenceNumber" name = "jobReferenceNumber" type = "text"> -->

                <?php
                    if (!empty($_SESSION['jobReferenceNumber']))
                    {
                        //not empty so check wether it has 5 characters
                        if (strlen($_SESSION['jobReferenceNumber']) != 5)
                        {
                            echo "<p id = 'apply-warning'>You require 5 characters for</p>";
                            $postSuccesfull = FALSE;
                        }
                    }
                    else {
                        //Check if job reference number hasn't been entered but has been posted
                        if (isset($_SESSION['jobReferenceNumber']))
                        {
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                            $postSuccesfull = FALSE;
                        }
                    }
                ?>
                <br>

                <label for = "firstName">First name:</label>
                <input id = "firstName" name = "firstName" type = "text">
                <?php
                    if (!empty($_SESSION['firstName']))
                    {
                        //name has been entered
                        //check for non-alpha characters and length of the string
                        if (CheckForSpecialCharacters($_SESSION['firstName']) || CheckIfInteger($_SESSION['firstName']) || strlen($_SESSION['firstName']) > 20)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>You can only have a maximum of 20 Alpha characters</p>";
                        }
                    }
                    else {
                        //Check if first name has been posted but not entered
                        if (isset($_SESSION['firstName']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>
                <label for = "lastName">Last name:</label>
                <input id = "lastName" name = "lastName" type = "text">
                <?php
                    if (!empty($_SESSION['lastName']))
                    {
                        //lastname has been entered
                        //check for non-alpha characters and length of the string
                        if (CheckForSpecialCharacters($_SESSION['lastName']) || CheckIfInteger($_SESSION['lastName']) || strlen($_SESSION['lastName']) > 20)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>You can only have a maximum of 20 Alpha characters</p>";
                        }
                    }
                    else {
                        //Check if last name has been posted but not entered
                        if (isset($_SESSION['lastName']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <label for = "DOB">Date of birth:</label>
                <input id = "DOB" name = "DOB" type = "date">
                <?php
                    if (!empty($_SESSION['dateOfBirth']))
                    {
                        //not empty no additional validation needed
                    }
                    else {
                        //Check if date of birth has been posted but not entered
                        if (isset($_SESSION['dateOfBirth']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>
                
                <fieldset>
                    <legend>Gender:</legend>
                    <input type="radio" id = "apply" name="gender" value="Male">
                    <label>Male</label>
                    <input type="radio" id = "apply" name="gender" value="Female">
                    <label>Female</label>
                    <input type="radio" id = "apply" name="gender" value="Other">
                    <label>Other</label>
                    <?php
                        if (!empty($_SESSION['gender']))
                        {
                        //   if a gender has been selected, not further action is required
                        }
                        else {
                            //Check if gender has been posted but not entered
                            if (isset($_SESSION['gender']))
                            {
                                $postSuccesfull = FALSE;
                                echo "<p id = 'apply-warning'>this entry is required</p>";
                            }
                        }
                    ?>
                </fieldset>
                <br>

                <label for = "streetAddress">Street Address:</label>
                <input id = "streetAddress" name = "streetAddress" type = "text">
                <?php
                    if (!empty($_SESSION['streetAddress']))
                    {
                        //Street Address exists so check that it has more than 40 characters
                        if (strlen($_SESSION['streetAddress']) > 40)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>Must have a maximum of 40 characters</p>";
                        }
                    }
                    else {
                        //Check if street address has been posted but no values entered
                        if (isset($_SESSION['streetAddress']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <label for = "suburbAndTown">Suburb/Town:</label>
                <input id = "suburbAndTown" name = "suburbAndTown" type = "text">
                <?php
                    if (!empty($_SESSION['suburbAndTown']))
                    {
                        //Suburb and address exists so check if have more that it has more than 40 characters
                        if (strlen($_SESSION['suburbAndTown']) > 40)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>Must have a maximum of 40 characters</p>";
                        }
                    }
                    else {
                        //check if suburb and town has been posted but not entered
                        if (isset($_SESSION['suburbAndTown']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <!-- The default blank value can't be selected as a state -->
                <label for = "state">State:</label>
                <select id = "state" name = "state">
                    <option value="" disabled selected>Please choose an option</option>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="TAS">TAS</option>
                    <option value="SA">SA</option>
                    <option value="WA">WA</option>
                    <option value="ACT">ACT</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                </select>
                <?php
                    if (!empty($_SESSION['state']))
                    { //if an option has been selected, no further action is neccessary
                    }
                    else {
                        //Check if state has  been posted but not entered
                        if (isset($_SESSION['state']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <label for = "postcode">Postcode:</label>
                <input id = "postcode" name = "postcode" type = "text">
                <?php
                    if (!empty($_SESSION['postcode']))
                    {
                        //not empty so check wether it has 4 characters
                        if (strlen($_SESSION['postcode']) != 4)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>You require 4 characters for</p>";
                        }
                    }
                    else {
                        //Check if postcode has been posted but not entered
                        if (isset($_SESSION['postcode']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <label for = "email">Email:</label>
                <input id = "email" name = "email" type = "text">
                <?php

                    if (!empty($_SESSION['email']))
                    {
                        //I
                        //Check that the email is in the valid form
                        if (CheckForSymbol("@", $_SESSION['email']) == FALSE)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>Email must be in valid format</p>";
                        }
                    }
                    else {
                        if (isset($_SESSION['email']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>

                <label for = "phoneNumber">Phone number:</label>
                <input id = "phoneNumber" name = "phoneNumber" type = "text">
                <?php
                    if (!empty($_SESSION['phoneNumber']))
                    {
                        //Check wether it is between 8 and 12 characters
                        if (strlen($_SESSION['phoneNumber']) < 8 || strlen($_SESSION['phoneNumber']) > 12)
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>Phone number must be between 8 & 12 characters</p>";
                        }
                    }
                    else {
                        //Check if phonenumber has been posted and not entered
                        if (isset($_SESSION['phoneNumber']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'apply-warning'>this entry is required</p>";
                        }
                    }
                ?>
                <br>
                <fieldset>
                    <!-- Skills list is a set of optional skills which the user can select -->
                    <!-- It is not required for the user to sumbit the form -->
                    <legend>Skills list:</legend>
                    <br>
                    <input type="checkbox" class = "apply" id = "communication" name="communication" value="communication">
                    <label>Communication</label>
                    <input type="checkbox" class = "apply" id = "css" name="css" value="css">
                    <label>CSS</label>
                    <input type="checkbox" class = "apply" id = "javascript" name="javascript" value="javascript">
                    <label>javascript</label>
                    <input type="checkbox" class = "apply" id = "php" name="php" value="php">
                    <label>PHP</label>
                    <input type="checkbox" class = "apply" id = "my_sql" name="my_sql" value="my_sql">
                    <label>MySQL</label>
                    <!-- No php validation required for this section -->

                </fieldset>
                <br>

                <!-- An optional section where the user can add additional information about themselves -->

                <label for = "otherSkills">Other Skills:</label>
                <textarea id = "otherSkills" name = "otherSkills" rows = "4" cols = "30"></textarea>
                <!-- No php validation required for this section -->
                <br>
                <?php
                    //Check whether or not there were errors with the submitions
                    if ($postSuccesfull == FALSE)
                    {
                        echo "<p id = 'apply-warning'>Please fix errors and try again</p>";
                    }
                    else //no errors
                    {
                        //Check wether we have just posted
                        if ($previouslyPosted == True)
                        {
                            //Add data to database
                            //set up variables by calling them from the session which is recieved from
                            //the 'Process_eoi.php' file.
                            $jobReferenceNumber = $_SESSION['jobReferenceNumber'];
                            $firstName = $_SESSION['firstName'];
                            $lastName = $_SESSION['lastName'];
                            $dateOfBirth = $_SESSION['dateOfBirth'];
                            $gender = $_SESSION['gender'];
                            $streetAddress = $_SESSION['streetAddress'];
                            $suburbTown = $_SESSION['suburbAndTown'];
                            $state = $_SESSION['state'];
                            $postcode = $_SESSION['postcode'];
                            $phoneNumber = $_SESSION['phoneNumber'];
                            $skillsList = $_SESSION['skills'];
                            $comments = $_SESSION['otherSkills'];
                            $formState = $_SESSION['formState'];
                            $email = $_SESSION['email'];
                        
                            //insert variables to query
                            //job_reference_number, first_name, last_name, date_of_birth, gender, street_address	suburb_town	state	postcode	phone_number	skills_list	comments	states	
                            $sql = "INSERT INTO eoi VALUES ($jobReferenceNumber, '$firstName', '$lastName', '$dateOfBirth', '$gender', '$streetAddress', '$suburbTown', '$state', $postcode, $phoneNumber, '$email', '$skillsList', '$comments', '$formState')";
                            //send the query to the database and hopefully works
                            if ($conn->query($sql) === TRUE) {
                                echo "<p id = 'apply-success'>New record created successfully</p>";
                            } else {
                                echo "<p id = 'apply-warning'>Error: " . $sql . "<br>" . $conn->error ."</p>";
                                echo "<p id = 'apply-warning'>Please fix errors and try again</p>";
                            }
                            //Close the connection
                            $conn->close();
                            //inform user of the issue
                            echo "<p id = 'apply-success'>Success</p>";
                        }
                    }
                ?>
                <!-- Submit button allows the user to submit their job information -->
                <input id = "submitButton" type = "submit" value = "submit">
                <!-- Reset button allows the user to clear all previous information -->
                <input id = "resetButton" type = "reset" value = "reset">
                </section>
            </form>
        </div>
        </div>
    </main>
    <!-- Add footer -->
    <?php include 'include/footer.inc'; ?>
