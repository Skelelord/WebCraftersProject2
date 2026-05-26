
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
        if (preg_match('/[^a-zA-Z0-9]/', $text))
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
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/ApplyPage.css">
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/Main.css">

<body>
    <?php include '../include/header_main.inc'; ?>

    <main>
        <?php 
            $postSuccesfull = TRUE;
            $previouslyPosted = False; //Checks wether posted from 'proccess_eoi.php'
            session_start();
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

            <?php
                if (!empty($_SESSION['jobReferenceNumber']))
                {
                    //not empty so check wether it has 5 characters
                    if (strlen($_SESSION['jobReferenceNumber']) != 5)
                    {
                        echo "<p id = 'warning'>You require 5 characters for</p>";
                        $postSuccesfull = FALSE;
                    }
                }
                else {
                    if (isset($_SESSION['jobReferenceNumber']))
                    {
                        echo "<p id = 'warning'>this entry is required</p>";
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
                        echo "<p id = 'warning'>You can only have a maximum of 20 Alpha characters</p>";
                    }
                }
                else {
                    if (isset($_SESSION['firstName']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
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
                        echo "<p id = 'warning'>You can only have a maximum of 20 Alpha characters</p>";
                    }
                }
                else {
                    if (isset($_SESSION['lastName']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
                    }
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
                    if (isset($_SESSION['dateOfBirth']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
                    }
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
                        if (isset($_SESSION['gender']))
                        {
                            $postSuccesfull = FALSE;
                            echo "<p id = 'warning'>this entry is required</p>";
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
                    if (strlen($_SESSION['postcode']) > 40)
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>Must have a maximum of 40 characters</p>";
                    }
                }
                else {
                    if (isset($_SESSION['streetAddress']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
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
                    if (strlen($_SESSION['postcode']) > 40)
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>Must have a maximum of 40 characters</p>";
                    }
                }
                else {
                    if (isset($_SESSION['suburbAndTown']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
                    }
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
            </select>
            <?php
                if (!empty($_SESSION['state']))
                {
                }
                else {
                    if (isset($_SESSION['state']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
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
                        echo "<p id = 'warning'>You require 4 characters for</p>";
                    }
                }
                else {
                    if (isset($_SESSION['postcode']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
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
                        echo "<p id = 'warning'>Email must be in valid format</p>";
                    }
                }
                else {
                    if (isset($_SESSION['email']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
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
                        echo "<p id = 'warning'>Phone number must be between 8 & 12 characters</p>";
                    }
                }
                else {
                    if (isset($_SESSION['phoneNumber']))
                    {
                        $postSuccesfull = FALSE;
                        echo "<p id = 'warning'>this entry is required</p>";
                    }
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
            <?php
                if ($postSuccesfull == FALSE)
                {
                    echo "<p id = 'warning'>Please fix errors and try again</p>";
                }
                else
                {

                    if ($previouslyPosted == True)
                    {
                        echo "<h2> Should Post</h2>";
                        //Post data to swinburne formtest
                        $url = 'https://swinburne.instructure.com/courses/71841/assignments/formtest.php';
                        $data = http_build_query(['First Name' => $_SESSION["firstName"], 'Last Name'=> $_SESSION["lastName"]]);
                
                        $options = [
                            'http' => [
                                "header" => "User-Agent: PHP\r\n"

                            ]
                        ];
                        $context  = stream_context_create($options);
                        $result = file_get_contents("https://mercury.swin.edu.au/it000000/formtest.php", false, $context);

                    }
                }
            ?>
            <input id = "submitButton" type = "submit" value = "submit">
            <input id = "resetButton" type = "reset" value = "reset">
            </section>
        </form>

        </div>
    </main>
    
     <?php include '../include/footer.inc'; ?>
