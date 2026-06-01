<?php
// session_start() at top of every page that uses sessions 
session_start();
// Check if $_SESSION['username'] is set before displaying protected page 
if (!isset($_SESSION['username'])) {
    header('Location: login/login.php');
    exit();
}
$logged_in_user = htmlspecialchars($_SESSION['username']);

// -------------------------------------------------------
// Database connection
// -------------------------------------------------------
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
        #belowheader {
            text-align: left;
            padding: 0.3em 0 1em 15%;
            margin-bottom: 0;
        }
        #belowheader p {
            color: cyan !important;
            font-size: medium;  
        }
        .welcome-text {
            margin: 0 0 0.2em 0;
            padding: 0;
        }
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; padding-top: 0; margin-top: 0; }
    </style>
</head>
<body>
<?php include 'include/header_main.inc'; ?>
<div id="belowheader">
    <h1>Manager <span class="colorchange">Dashboard</span></h1>
    <p class="welcome-text"><i>"Welcome, <strong><?= $logged_in_user ?></strong>" | <a href="Login/logout.php">Logout</a></i></p>
</div> 
<div id="manage">
<main>
<?php
$message = "";

// -------------------------------------------------------
// Update EOI status - triggered when the manager submits
// the status change form on an individual EOI row
// -------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $eoi_id     = mysqli_real_escape_string($conn, trim($_POST['eoi_id']));
    $new_status = mysqli_real_escape_string($conn, trim($_POST['new_status']));

    // Whitelist check - only allow known status values
    $allowed_statuses = ['new', 'current', 'final'];
    if (in_array($new_status, $allowed_statuses) && $eoi_id !== '') {
        $sql = "UPDATE eoi SET states = '$new_status' WHERE eoi_id = '$eoi_id'";
        if (mysqli_query($conn, $sql)) {
            $message = "<p style='color:green;'>Status updated successfully.</p>";
        } else {
            $message = "<p style='color:red;'>Error updating status: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Invalid status or EOI ID.</p>";
    }
}

// -------------------------------------------------------
// Delete EOIs by Job Reference - removes all EOI records
// that match the given job reference number
// -------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_eois'])) {
    $del_jobref = mysqli_real_escape_string($conn, trim($_POST['del_jobref']));
    if ($del_jobref !== '') {
        $sql = "DELETE FROM eoi WHERE job_reference_number = '$del_jobref'";
        if (mysqli_query($conn, $sql)) {
            $rows = mysqli_affected_rows($conn);
            $message = "<p style='color:green;'>Deleted $rows EOI(s) for job reference '$del_jobref'.</p>";
        } else {
            $message = "<p style='color:red;'>Error deleting: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Please enter a job reference to delete.</p>";
    }
}

// -------------------------------------------------------
// Build query - apply sort and filter parameters from GET
// to fetch the relevant EOI rows from the database
// -------------------------------------------------------
$allowed_sort = ['job_reference_number', 'first_name', 'last_name', 'states'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sort)
        ? $_GET['sort']
        : 'job_reference_number';

$where = "1=1";
$filter_jobref    = isset($_GET['filter_jobref'])    ? mysqli_real_escape_string($conn, trim($_GET['filter_jobref']))    : '';
$filter_firstname = isset($_GET['filter_firstname']) ? mysqli_real_escape_string($conn, trim($_GET['filter_firstname'])) : '';
$filter_lastname  = isset($_GET['filter_lastname'])  ? mysqli_real_escape_string($conn, trim($_GET['filter_lastname']))  : '';

// Append filter conditions only if the field was submitted
if ($filter_jobref !== '')    { $where .= " AND job_reference_number = '$filter_jobref'"; }
if ($filter_firstname !== '') { $where .= " AND first_name LIKE '%$filter_firstname%'"; }
if ($filter_lastname !== '')  { $where .= " AND last_name LIKE '%$filter_lastname%'"; }

$sql = "SELECT * FROM eoi WHERE $where ORDER BY $sort ASC";

// Only run the query if the EOI table exists
if (mysqli_query($conn, "SHOW TABLES LIKE 'eoi'")->num_rows > 0) {
    $result   = mysqli_query($conn, $sql);
    $eoi_rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
} else {
    $eoi_rows = [];
    $message = "<p style='color:orange;'>EOI table not set up yet.</p>";
}
?>
<?php
// -------------------------------------------------------
// Statistics - count totals per status and per job reference
// used to populate the stats panel at the top of the page
// -------------------------------------------------------
$total         = count($eoi_rows);
$new_count     = 0;
$current_count = 0;
$final_count   = 0;
$job_counts    = [];
foreach ($eoi_rows as $row) {
    if ($row['states'] === 'new')     $new_count++;
    if ($row['states'] === 'current') $current_count++;
    if ($row['states'] === 'final')   $final_count++;
    $ref = $row['job_reference_number'];
    $job_counts[$ref] = isset($job_counts[$ref]) ? $job_counts[$ref] + 1 : 1;
}
?>

<!-- Statistics panel - displays EOI counts by status and job reference -->
<section id="stats-panel">
    <h2>📊 EOI Statistics</h2>
    <div id="stats-grid">
        <div class="stat-box">
            <span class="stat-number"><?= $total ?></span>
            <span class="stat-label">Total EOIs</span>
        </div>
        <div class="stat-box new-box">
            <span class="stat-number"><?= $new_count ?></span>
            <span class="stat-label">New</span>
        </div>
        <div class="stat-box current-box">
            <span class="stat-number"><?= $current_count ?></span>
            <span class="stat-label">Current</span>
        </div>
        <div class="stat-box final-box">
            <span class="stat-number"><?= $final_count ?></span>
            <span class="stat-label">Final</span>
        </div>
        <?php foreach ($job_counts as $ref => $count): ?>
        <div class="stat-box job-box">
            <span class="stat-number"><?= $count ?></span>
            <span class="stat-label"><?= htmlspecialchars($ref) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?= $message ?>

<!-- Search and filter form - uses GET so filters are bookmarkable/shareable -->
<section>
    <h2>Search &amp; Filter EOIs</h2>
    <form method="GET" action="manage.php">
        <label>Job Reference: <input type="text" name="filter_jobref" value="<?= htmlspecialchars($filter_jobref) ?>" placeholder="e.g. SMC01 or SMC02"></label><br><br>
        <label>First Name: <input type="text" name="filter_firstname" value="<?= htmlspecialchars($filter_firstname) ?>" placeholder="First name"></label><br><br>
        <label>Last Name: <input type="text" name="filter_lastname" value="<?= htmlspecialchars($filter_lastname) ?>" placeholder="Last name"></label><br><br>
        <label>Sort by:
            <select name="sort">
                <option value="job_reference_number" <?= $sort === 'job_reference_number' ? 'selected' : '' ?>>Job Reference</option>
                <option value="first_name"           <?= $sort === 'first_name'           ? 'selected' : '' ?>>First Name</option>
                <option value="last_name"            <?= $sort === 'last_name'            ? 'selected' : '' ?>>Last Name</option>
                <option value="states"               <?= $sort === 'states'               ? 'selected' : '' ?>>Status</option>
            </select>
        </label><br><br>
        <button type="submit">List All / Search</button>
        <a href="manage.php">Clear</a>
    </form>
</section>

<!-- Results table - lists all EOIs matching the current filter/sort -->
<section>
    <h2>EOI Results</h2>
    <?php if (empty($eoi_rows)): ?>
        <p>No EOIs found.</p>
    <?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>EOI ID</th>
                <th>Job Reference</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eoi_rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['eoi_id']) ?></td>
                <td><?= htmlspecialchars($row['job_reference_number']) ?></td>
                <td><?= htmlspecialchars($row['first_name']) ?></td>
                <td><?= htmlspecialchars($row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                <td><?= htmlspecialchars($row['states']) ?></td>
                <td>
                    <!-- Inline status update form - uses eoi_id for row targeting -->
                    <form method="POST" action="manage.php">
                        <!-- uses eoi_id for row targeting -->
                        <input type="hidden" name="eoi_id" value="<?= htmlspecialchars($row['eoi_id']) ?>">
                        <select name="new_status">
                            <option value="new"     <?= $row['states'] === 'new'     ? 'selected' : '' ?>>New</option>
                            <option value="current" <?= $row['states'] === 'current' ? 'selected' : '' ?>>Current</option>
                            <option value="final"   <?= $row['states'] === 'final'   ? 'selected' : '' ?>>Final</option>
                        </select>
                        <button type="submit" name="change_status">Update</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</section>

<!-- Delete section - removes all EOIs for a given job reference -->
<section>
    <h2>Delete EOIs by Job Reference</h2>
    <form method="POST" action="manage.php"
          onsubmit="return confirm('Are you sure? This cannot be undone.');"> <!-- Javasript confirmation prompt for deletion -->
        <label>Job Reference: <input type="text" name="del_jobref" placeholder="e.g. 00001 or 00005" required></label>
        <button type="submit" name="delete_eois">Delete All EOIs</button>
    </form>
</section>

</main>
</div>
<?php
// Close the database connection and load the shared footer
mysqli_close($conn);
include 'include/footer.inc';
?>
</body>
</html>