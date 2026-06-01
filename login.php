<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="HR Manager Login - UrbanPulse Dynamics">
    <title>Manager Login - UrbanPulse Dynamics</title>
    <link rel="stylesheet" type="text/css" href="CSS/Main.css">
    <style>
        #belowheader {
            text-align: left;
            padding: 0.3em 0 1em 15%;
        }
        #belowheader p {
            color: cyan !important;
            font-size: medium;
        }
        /* Fix footer to bottom */
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; }

        /* Centre login box */
        .login-wrapper { text-align: center; padding: 0.5em; }

        /* Login box */
        .login-box { display: inline-block; background-color: rgb(16, 36, 92); border: 2px solid #e8b84b; border-radius: 14px; padding: 2em; width: 350px; text-align: left; }
        .login-box input[type="text"],
        .login-box input[type="password"] { display: block; width: 100%; box-sizing: border-box; margin-bottom: 1em; padding: 0.5em; background-color: white !important; color: black !important; }

        /* Login button */
        .login-box input[type="submit"] { width: 100%; padding: 0.6em; margin-top: 0.5em; }

        /* Error message */
        .error-msg { color: red; margin-bottom: 1em; }
    </style>
</head>
<body>

<?php include 'include/header_main.inc'; ?>

<div id="belowheader">
    <h1>Manager<span class="colorchange">Login</span></h1>
    <p><i>"Authorised access only"</i></p>
</div>


<?php
// session_start() at top of every page that uses sessions 
session_start();

// If already logged in - go to manage page
if (isset($_SESSION['username'])) {
    header('Location: manage.php');
    exit();
}
// Load database connection details
require_once("settings.php");
// Holds any error message to display to the user
$error = '';

// Connect to database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("<p>Unable to connect to the database.</p>");
}

// Auto create admin/admin on first run if no users exist
$count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$count_row    = mysqli_fetch_assoc($count_result);

if ((int)$count_row['total'] === 0) {
    // password_hash() - never store plain text
    $hashed_password = password_hash('admin', PASSWORD_DEFAULT);
    $admin_name = 'admin';

    // Use prepared statement 
    $stmt = mysqli_prepare($conn,
        "INSERT INTO users (username, password_hash) VALUES (?, ?)");
    // 'ss' means both values being bound are strings
    mysqli_stmt_bind_param($stmt, 'ss', $admin_name, $hashed_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate user input 
    $input_username = trim($_POST['username']);
    $input_password = $_POST['password'];

    if (empty($input_username) || empty($input_password)) {
        $error = "Both username and password are required.";

    } else {

        // Use prepared statements to prevent SQL injection 
        $stmt = mysqli_prepare($conn,
            "SELECT user_id, password_hash FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, 's', $input_username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user_row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        // password_verify() compares the typed password against the stored hash.
        if ($user_row && password_verify($input_password, $user_row['password_hash'])) {
            // Regenerate session ID after login to prevent session fixation attacks
            session_regenerate_id(true);
            // $_SESSION['username'] stores data 
            $_SESSION['username'] = $input_username;
            $_SESSION['user_id']  = $user_row['user_id'];

            mysqli_close($conn);

            // Redirect to manage page
            header('Location: manage.php');
            exit();

        } else {
            $error = "Incorrect username or password.";
        }
    }
}

mysqli_close($conn);
?>

<main>
    <div class="login-wrapper">
        <div class="login-box">
            <!-- Show error if login failed -->
            <?php if ($error != ''): ?>
                <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">

                <label for="username">Username:</label>
                <input type="text"
                       id="username"
                       name="username"
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                       >

                <label for="password">Password:</label>
                <input type="password"
                       id="password"
                       name="password"
                       >

                <input type="submit" value="Login">

            </form>

        </div>
    </div>
</main>

<?php include 'include/footer.inc'; ?>

</body>
</html>