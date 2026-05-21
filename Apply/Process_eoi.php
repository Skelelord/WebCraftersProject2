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
            //Get the data posted
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

            // Page 1
            session_start();
            $_SESSION['posted'] = true;
            $_SESSION['username'] = "Bill Murry";

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

            header('Location: Apply.php');
            //Checkbox values
            // $communication = $_POST["communication"];
            // $css = $_POST["css"];
            // $javascript = $_POST["javascript"];
            // $php = $_POST["php"];
            // $my_sql = $_POST["my_sql"];
            //  $pets = isset($_POST["pet"]) ? $_POST["pet"] : [];
            if (empty($jobReferenceNumber)) {
                echo "<p>Job reference number is required<p>";
            }
            else if (strlen($jobReferenceNumber) != 5)
            {
                echo "<p>You must have 5 characters for the job refernce number \n<p>";
            }

            if (empty($firstName)) {
                echo "<p>You require a first name \n<p>";
            }
            else if (strlen($firstName) > 20)
            {
                echo "<p>First names should have a minimum of 20 characters \n<p>";
            }
            if (empty($lastName))
            {
                echo "<p>You require a last name<p>";
            }
            else if (strlen($lastName) > 20)
            {
                echo "<p>Last names should have a maximum of 20 characters<p>";
            }

            if (empty($DOB)) 
            {
                echo "<p>You have a date of birth<p>";
            } 
            if (empty($gender))
            {
                echo "<p>Gender is required<p>";
            }
            if (empty($streetAddress))
            {
                echo "<p>Street Address is required<p>";
            }
            else if (strlen($streetAddress) > 40)
            {
                echo "<p>Street address must have a max of 40 characters<p>";
            }
            if (empty($suburbAndTown))
            {
                echo "<p>Suburb and Town is required<p>";
            }
            else if (strlen($suburbAndTown) > 40)
            {
                echo "<p>Suburb and town must have a max of 40 characters<p>";
            }
            if (empty($state))
            {
                echo "<p>state is required <p>";
            }
        }
        else
        {
            //Nothing posted, reroute to another page
            header('Location: Apply.php');
        }
    ?>
<body>