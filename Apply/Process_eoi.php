<!DOCTYPE html>
<html lang="en" title="Apply Page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8" />
  <meta name="description" content="Apply for job" />
  <meta name="keywords" content="HTML5, CSS layout" />
  <meta name="author" content="Christopher"  />
  <title>CSS Layout</title>
<body>
    <?php
        function sanitise_input($data)
        {
            $data = trim($data);
            //$data = striplashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Check if message came in from the server
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            //Get the data posted and santise it
            $jobReferenceNumber = sanitise_input($_POST["jobReferenceNumber"]);
            $firstName = sanitise_input($_POST["firstName"]);
            $lastName = sanitise_input($_POST["lastName"]);
            $DOB = $_POST["DOB"];
            $gender = isset($_POST["gender"]) ? $_POST["gender"] : [];
            $streetAddress = $_POST["streetAddress"];
            $suburbAndTown = isset($_POST["suburbAndTown"]) ? $_POST["suburbAndTown"]: [];
            $suburbAndTown = sanitise_input($suburbAndTown);
            $state = isset($_POST["state"]) ? $_POST["state"] : [];
            
            $postcode = sanitise_input($_POST["postcode"]);
            $email = sanitise_input($_POST["email"]);
            $phoneNumber = sanitise_input($_POST["phoneNumber"]);
            $otherSkills = sanitise_input($_POST["otherSkills"]);

            //Set values
            $communicationState = isset($_POST["communication"]) ? $_POST["communication"] : "";
            $cssState = isset($_POST["css"]) ? $_POST["css"] : "";
            $javascriptState = isset($_POST["javascript"]) ? $_POST["javascript"] : "";
            $phpState = isset($_POST["php"]) ? $_POST["php"] : "";
            $my_sql = isset($_POST["my_sql"]) ? $_POST["my_sql"] : "";

            $formState = $_POST['formState'];

            // Page 1
            //Set up session
            session_start();
            
            //Setup session variables
            $_SESSION['posted'] = true;
            $_SESSION['username'] = "Bill Murry";
            $_SESSION['jobReferenceNumber'] = $jobReferenceNumber;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['dateOfBirth'] = $DOB;
            $_SESSION['gender'] = $gender;
            $_SESSION['streetAddress'] = $streetAddress;
            $_SESSION['suburbAndTown'] = $suburbAndTown;
            $_SESSION['postcode'] = $postcode;
            $_SESSION['state'] = $state;
            $_SESSION['email'] = $email;
            $_SESSION['phoneNumber']  = $phoneNumber;
            $_SESSION['otherSkills'] = $otherSkills;
            $_SESSION['formState'] = $formState;
            $_SESSION['skills'] = $communicationState . ", " . $cssState . ", " . $javascriptState . ", " . $phpState . ", " . $my_sql;
            //Reroute to the apply page
            header('Location: Apply.php');
            //Checkbox values
            // $communication = $_POST["communication"];
            // $css = $_POST["css"];
            // $javascript = $_POST["javascript"];
            // $php = $_POST["php"];
            // $my_sql = $_POST["my_sql"];
            //  $pets = isset($_POST["pet"]) ? $_POST["pet"] : [];
        }
        else
        {
            //Nothing posted, reroute to another page
            header('Location: Apply.php');
        }
    ?>
<body>