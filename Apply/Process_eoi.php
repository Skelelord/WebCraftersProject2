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
            //Checkbox values
            // $communication = $_POST["communication"];
            // $css = $_POST["css"];
            // $javascript = $_POST["javascript"];
            // $php = $_POST["php"];
            // $my_sql = $_POST["my_sql"];
            //  $pets = isset($_POST["pet"]) ? $_POST["pet"] : [];

            if (empty($jobReferenceNumber)) {
                echo "Job reference number is required";
            }
            else if (empty($firstName)) {
                echo "You require a first name";
            }
            else if (empty($lastName))
            {
                echo "You require a last name";
            }
            else if (empty($DOB)) 
            {
                echo "You have a date of birth";
            } 
            else if (empty($gender))
            {
                echo "Gender is required";
            }
            else if (empty($streetAddress))
            {
                echo "Street Address is required";
            }
            else if (empty($suburbAndTown))
            {
                echo "Suburb and Town is required";
            }
            else if (empty($state))
            {
                echo "state is required";
            }
        }
        else
        {
            //Reroute to another page
            header('Location: Apply.php');
        }
    ?>
<body>