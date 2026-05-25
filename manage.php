<?php
// Connect to database
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Unable to connect to the database.</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - UrbanPulse Dynamics</title>
    <link rel="stylesheet" type="text/css" href="CSS/Main.css">
    <style>   
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; }
    </style>
</head>
<body>
<?php include 'include/header_main.inc'; ?> 

<main>
    <?php
    // Member 4 you will start writing code FROM HERE
    // $conn is ready to use — no need to reconnect
    // ------
    // ------
    // ------
    // end here
    ?>
</main>
<?php
mysqli_close($conn);
include 'include/footer.inc';
?>
</body>
</html>