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
        require_once("settings.php");

        //Sanitise incoming data to prevent sql injection
        function sanitise_input($data)
        {
            $data = trim($data);
            //$data = striplashes($data);
            //$data = $mysqli->mysqli_real_escape_string($data);
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
            if (session_start() === PHP_SESSION_NONE)
            {
                //No session active, create new
                session_start();
            }

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
            
            $conn = mysqli_connect($host, $username, $password, $database);


            //now check whether the webpage exists to see if we need to add another table
            if (mysqli_query($conn, "DESCRIBE `eoi`")) 
            {
                //webpage exists, no further action needed
            }
            else
            {
                //table does not exist in database
                //Create table
                $sql = "CREATE TABLE eoi (
                    job_reference_number char(5) PRIMARY KEY NOT NULL,
                    first_name varchar(20) NOT NULL,
                    last_name varchar(20) NOT NULL,
                    date_of_birth varchar(20) NOT NULL,
                    gender ENUM('male', 'female', 'other') NOT NULL DEFAULT 'other',
                    street_address varchar(40) NOT NULL,
                    suburb_town varchar(20) NOT NULL,
                    state char(3) NOT NULL,
                    postcode char(4) NOT NULL,
                    phone_number varchar(12) NOT NULL,
                    email varchar(254) NOT NULL,
                    skills_list varchar(20) DEFAULT NULL,
                    comments text DEFAULT NULL,
                    states ENUM('new', 'current', 'final') NOT NULL DEFAULT 'new'
                );";
                //send the query to the database and hopefully works
                if ($conn->query($sql) === TRUE) {
                    echo "<p>New record created successfully</p>";
                } else {
                    echo "<p id = 'warning'>Error: " . $sql . "<br>" . $conn->error ."</p>";
                    echo "<p id = 'warning'>Please fix errors and try again</p>";
                }
                //Close the connection
                $conn->close();

                
            }
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