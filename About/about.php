<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="About our team" >
  <meta name="keywords" content="HTML5, CSS layout" >
  <meta name="author" content="Lamia Ahmed Khan" >
  <title>About our Team</title>
   
  <link rel="stylesheet" type="text/css" href="../CSS/About.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Main.css">

<style>
    #content h2 {
      letter-spacing: 0.5px;
    }
  </style>
</head>
<body>
    <?php include '../include/header_main.inc'; ?>

<main>

    <div id="belowheader">
            <h1>About<span class="colorchange"> Us</span></h1>
            <p><i>"Team Members of our group project"</i></p>
    </div>

    <div id = "content">
        <section>
            <h2>Group Information</h2>
            <ul>
                <li>Group Name: WebCrafters
                    <ul>
                        <li>Class Day: Friday</li>
                        <li>Time: 8:30 AM</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section>
            <h2>Team Members</h2>
             <?php
             require_once '../settings.php';
             $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
             if ($dbconn) {
                $query = "SELECT * FROM members";
                $result = @mysqli_query($dbconn, $query);
                if ($result) {
                    echo "<dl>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<dt>" . $row['name'] . " - " . $row['role'] . "</dt>";
                        echo "<dd><strong>Part 1:</strong> " . $row['project_Part1_contribution'] . "</dd>";
                        echo "<dd><strong>Part 2:</strong> " . $row['project_Part2_contribution'] . "</dd>";
                    }
                    echo "</dl>";
                }
                mysqli_close($dbconn);
            } else {
                echo "<p>Unable to connect to the database.</p>";
            }
             ?>
        </section>

        <section>
            <h2>Our Team</h2>

            <figure>
                <img src="../images/groupphoto.jpg" alt="Group photo of our team" width="300">
                <figcaption style="letter-spacing: 0.5px;">Our project team</figcaption>
            </figure>
        </section>
        <section id="student-id-section">
            <h2>Student IDs</h2>
            <p id="id1">Christopher Rose: 105920174</p>
            <p id="id2">Lamia Ahmed Khan: 105999789</p>
            <p id="id3">Zarin Tasnim: 105981579</p>
            <p id="id4">Dorar Alodhlah: 106522429</p>
</section>

        <section>
            <h2>Fun Facts</h2>

            <table>
                <caption>Fun facts about our team</caption>

                <tr>
                    <th>Name</th>
                    <th>Dream Job</th>
                    <th>Coding Snack</th>
                    <th>Hometown</th>
                </tr>

                <tr>
                    <td>Christopher</td>
                    <td>Game Developer</td>
                    <td>Chocolate</td>
                    <td>Geelong</td>
                </tr>

                <tr>
                    <td>Lamia</td>
                    <td>Software Developer</td>
                    <td>Chocolate</td>
                    <td>Dhaka</td>
                </tr>
                <tr>
                    <td>Zarin</td>
                    <td>Machine Learning Engineer</td>
                    <td>Chips</td>
                    <td>Dhaka</td>
                </tr> 
                <tr>
                    <td>Dorar</td>
                    <td>AI software developer</td>
                    <td>Popcorn</td>
                    <td>Keysborough</td>
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

<?php include '../include/footer.inc'; ?>

