<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Job positions available at UrbanPulse Dynamics">
    <meta name="keywords" content="jobs, smart city, urban, UrbanPulse Dynamics">
    <meta name="author" content="Zarin">
    <title>Job Positions - UrbanPulse Dynamics</title>
    <link rel="stylesheet" type="text/css" href="CSS/Main.css">
    <link rel="stylesheet" type="text/css" href="jobsCSS/jobs.css">
    <!-- Embedded CSS -->
     <style>
        .job-container h2 {
            text-decoration: underline;
            color: #e8b84b !important;
        }
        .job-container h3 {
            color: #e8b84b !important;
        }
    
        footer a {
            text-decoration: underline !important;
        }
        .jobs-page p,
        .job-container p,
        .job-aside p {
            color: white !important;
        }
    </style>
     
</head>
<body>
    <?php include 'include/header_main.inc'; ?> 

    <div id="belowheader">
        <h1>Jo<span class="colorchange">bs</span></h1>
        <p><i>"Build your career with UrbanPulse Dynamics"</i></p>
    </div>

<main class="jobs-page">
    
    <!-- Search Form -->
    <form action="jobs.php" method="GET">
        <label for="search">Search Jobs:</label>
        <input type="text"
               id="search"
               name="search"
               placeholder="e.g. Transport, Engineer, SMC01"
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
               required>
        <input type="submit" value="Search">
    </form>

    <?php
    // Function to sanitise input 
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Connect to database
    require_once("settings.php");
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("<p>Unable to connect to the database.</p>");
    }

    // Check if search was submitted 
    if (isset($_GET['search'])) {

        // Collect and sanitise input 
        $search = sanitise_input($_GET['search']);

        // Extra protection for database 
        $search_safe = mysqli_real_escape_string($conn, $search);

        $sql = "SELECT * FROM jobs
                WHERE title    LIKE '%$search_safe%'
                   OR job_ref  LIKE '%$search_safe%'
                   OR job_type LIKE '%$search_safe%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<p><strong>" . mysqli_num_rows($result) . "</strong> result(s) found for: <strong>" . htmlspecialchars($search) . "</strong></p>";

            while ($row = mysqli_fetch_assoc($result)) {
                // Sanitise all output
                $ref        = htmlspecialchars($row['job_ref']);
                $title      = htmlspecialchars($row['title']);
                $sal_min    = number_format($row['salary_min']);
                $sal_max    = number_format($row['salary_max']);
                $location   = htmlspecialchars($row['location']);
                $job_type   = htmlspecialchars($row['job_type']);
                $apply_by   = date('d F Y', strtotime($row['apply_by']));
                $intro      = htmlspecialchars($row['intro']);
                $sal_detail = htmlspecialchars($row['salary_detail']);
                $reports_to = htmlspecialchars($row['reports_to']);

                echo "<section class='job-container' aria-labelledby='job-$ref-title'>";

                    echo "<aside class='job-aside'>";
                        echo "<h2>Quick Info</h2>";
                        echo "<p><strong>Ref:</strong> $ref</p>";
                        echo "<p><strong>Salary:</strong> \$$sal_min - \$$sal_max</p>";
                        echo "<p><strong>Location:</strong> $location</p>";
                        echo "<p><strong>Type:</strong> $job_type</p>";
                        echo "<p><strong>Apply by:</strong> $apply_by</p>";
                        echo "<a href='../Apply/Apply.php?ref=$ref'
                                  style='display:block; margin-top:10px;
                                         background-color:rgb(2,2,141); color:rgb(232,154,9);
                                         text-align:center; padding:8px;
                                         text-decoration:none; border-radius:4px;'
                                  aria-label='Apply for $title'>Apply Now</a>";
                    echo "</aside>";

                    echo "<h2 id='job-$ref-title'>$title</h2>";
                    echo "<p><span style='color:#38bdf8; font-weight:bold;'>Reference Number: $ref</span></p>";
                    // echo "<p class='ref-number'>Reference Number: $ref</p>";
                    echo "<p>$intro</p>";

                    echo "<h3>Salary and Reporting Line</h3>";
                    echo "<p>Salary: $sal_detail</p>";
                    echo "<p>Reports to: $reports_to</p>";

                    echo "<h3>Key Responsibilities</h3><ol>";
                    foreach (explode("\n", $row['responsibilities']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ol>";

                    echo "<h3>Essential Requirements</h3><ul>";
                    foreach (explode("\n", $row['essential_req']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ul>";

                    echo "<h3>Preferable Requirements</h3><ul>";
                    foreach (explode("\n", $row['preferable_req']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ul>";

                echo "</section>";

            }
        } else {
            echo "<div>";
            echo "<p>No matching jobs found for: <strong>" . htmlspecialchars($search) . "</strong></p>";
            echo "<p><a href='jobs.php'>Search Again</a></p>";
            echo "</div>";
        }

    } else {

        $result = mysqli_query($conn, "SELECT * FROM jobs");

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<p> Showing <strong>" . mysqli_num_rows($result) . "</strong> position(s)</p>";

            while ($row = mysqli_fetch_assoc($result)) {

                $ref        = htmlspecialchars($row['job_ref']);
                $title      = htmlspecialchars($row['title']);
                $sal_min    = number_format($row['salary_min']);
                $sal_max    = number_format($row['salary_max']);
                $location   = htmlspecialchars($row['location']);
                $job_type   = htmlspecialchars($row['job_type']);
                $apply_by   = date('d F Y', strtotime($row['apply_by']));
                $intro      = htmlspecialchars($row['intro']);
                $sal_detail = htmlspecialchars($row['salary_detail']);
                $reports_to = htmlspecialchars($row['reports_to']);

                echo "<section class='job-container' aria-labelledby='job-$ref-title'>";

                    echo "<aside class='job-aside'>";
                        echo "<h2>Quick Info</h2>";
                        echo "<p><strong>Ref:</strong> $ref</p>";
                        echo "<p><strong>Salary:</strong> \$$sal_min - \$$sal_max</p>";
                        echo "<p><strong>Location:</strong> $location</p>";
                        echo "<p><strong>Type:</strong> $job_type</p>";
                        echo "<p><strong>Apply by:</strong> $apply_by</p>";
                        echo "<a href='../Apply/Apply.php?ref=$ref'
                                  style='display:block; margin-top:10px;
                                         background-color:rgb(2,2,141); color:rgb(232,154,9);
                                         text-align:center; padding:8px;
                                         text-decoration:none; border-radius:4px;'
                                  aria-label='Apply for $title'>Apply Now</a>";
                    echo "</aside>";

                    echo "<h2 id='job-$ref-title'>$title</h2>";
                    echo "<p><span style='color:#38bdf8; font-weight:bold;'>Reference Number: $ref</span></p>";
                    // echo "<p class='ref-number'>Reference Number: $ref</p>";
                    echo "<p>$intro</p>";

                    echo "<h3>Salary and Reporting Line</h3>";
                    echo "<p>Salary: $sal_detail</p>";
                    echo "<p>Reports to: $reports_to</p>";

                    echo "<h3>Key Responsibilities</h3><ol>";
                    foreach (explode("\n", $row['responsibilities']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ol>";

                    echo "<h3>Essential Requirements</h3><ul>";
                    foreach (explode("\n", $row['essential_req']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ul>";

                    echo "<h3>Preferable Requirements</h3><ul>";
                    foreach (explode("\n", $row['preferable_req']) as $item) {
                        if (trim($item) != '') echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    echo "</ul>";

                echo "</section>";

            } 

        } else {
            echo "<p>No jobs found in the database.</p>";
        }
    }
    mysqli_close($conn);
    ?>

</main>
<?php include 'include/footer.inc'; ?>
</body>
</html>