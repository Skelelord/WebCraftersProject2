<!DOCTYPE html>
<html lang="en">
<head  class = "page-about">
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="About our team" >
  <meta name="keywords" content="HTML5, CSS layout" >
  <meta name="author" content="Lamia Ahmed Khan" >
  <title>About our Team</title>
   
  <link rel="stylesheet" type="text/css" href="CSS/Main.css">

<style>
    #content h2 {
      letter-spacing: 0.5px;
    }
  </style>
</head>
<body class = "page-about">
    <?php include 'include/header_main.inc'; ?>

<main>

    <div id="belowheader" class = "page-about">
            <h1>About<span class="colorchange"> Us</span></h1>
            <p><i>"Team Members of our group project"</i></p>
    </div>

    <div id = "content">
        <section  class = "page-about">
            <h2  class = "page-about">Group Information</h2>
            <ul>
                <li class = "page-about">Group Name: WebCrafters
                    <ul class = "page-about">
                        <li class = "page-about">Class Day: Friday</li>
                        <li class = "page-about">Time: 8:30 AM</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section  class = "page-about">
            <h2  class = "page-about">Team Members</h2>
             <?php
             require_once 'settings.php'; // Include the database connection settings
             $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db); //opens a connection to the database
             if ($dbconn) {
                $query = "SELECT * FROM members"; // SQL query to select all records from the 'members' table
                $result = @mysqli_query($dbconn, $query); // Executes the SQL query and returns the result set + @ to suppress error messages
                if ($result) { // Checks if the query was successful
                    echo "<dl>"; // Start of definition list
                    while ($row = mysqli_fetch_assoc($result)) { // Fetches each row of the result set as an associative array
                        echo "<dt>" . $row['name'] . " - " . $row['role'] . "</dt>"; 
                        echo "<dd><strong>Part 1:</strong> " . $row['project_Part1_contribution'] . "</dd>";
                        echo "<dd><strong>Part 2:</strong> " . $row['project_Part2_contribution'] . "</dd>";
                    } // End of while loop
                    echo "</dl>"; // End of definition list
                }
                mysqli_close($dbconn); // Closes the database connection
            } else { // If the connection fails, display an error message
                echo "<p>Unable to connect to the database.</p>"; // Error handling for database connection failure
            }
             ?>
        </section>

        <section  class = "page-about">
            <h2 class = "page-about">Our Team</h2>

            <figure class = "page-about">
                <img src="../images/groupphoto.jpg" alt="Group photo of our team" width="300">
                <figcaption style="letter-spacing: 0.5px;">Our project team</figcaption>
            </figure>
        </section>
        <section class = "page-about" id="student-id-section">
            <h2 class = "page-about">Student IDs</h2>
            <p class = "page-about" id="id1">Christopher Rose: 105920174</p>
            <p class = "page-about" id="id2">Lamia Ahmed Khan: 105999789</p>
            <p class = "page-about" id="id3">Zarin Tasnim: 105981579</p>
            <p class = "page-about" id="id4">Dorar Alodhlah: 106522429</p>
</section class = "page-about">

        <section  class = "page-about">
            <h2 class = "page-about">Fun Facts</h2>

            <table class = "page-about">
                <caption class = "page-about">Fun facts about our team</caption>

                <tr class = "page-about">
                    <th class = "page-about">Name</th>
                    <th class = "page-about">Dream Job</th>
                    <th class = "page-about">Coding Snack</th>
                    <th class = "page-about">Hometown</th>
                </tr>

                <tr class = "page-about">
                    <td class = "page-about">Christopher</td>
                    <td class = "page-about">Game Developer</td>
                    <td class = "page-about">Chocolate</td>
                    <td class = "page-about">Geelong</td>
                </tr>

                <tr class = "page-about">
                    <td class = "page-about">Lamia</td>
                    <td class = "page-about">Software Developer</td>
                    <td class = "page-about">Chocolate</td>
                    <td class = "page-about">Dhaka</td>
                </tr>
                <tr class = "page-about">
                    <td class = "page-about">Zarin</td>
                    <td class = "page-about">Machine Learning Engineer</td>
                    <td class = "page-about">Chips</td>
                    <td class = "page-about">Dhaka</td>
                </tr> 
                <tr class = "page-about">
                    <td class = "page-about">Dorar</td>
                    <td class = "page-about">AI software developer</td>
                    <td class = "page-about">Popcorn</td>
                    <td class = "page-about">Keysborough</td>
                </tr>


            </table>
        </section>
        
        <section>
            <h2>Acknowledgement</h2>
            <p>We acknowledge the Aboriginal and Torres Strait Islander peoples of the land on which we study and work. We recognize their continuing connection to land, waters, and culture and pay our respects to Elders past, present, and emerging.We are committed to support Aboriginal and Torres Strait Islander peoples and creating an inclusive environment.</p><!-- Help taken from AI for content-->
        </section>

    </div>

</main>
<br>

<?php include 'include/footer.inc'; ?>

