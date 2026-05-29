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
<?php include 'include/header_manage.inc'; ?> 

<main>
    <!-- Zarin can add logout button here -->

<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $eoi_id     = mysqli_real_escape_string($conn, trim($_POST['eoi_id']));
    $new_status = mysqli_real_escape_string($conn, trim($_POST['new_status']));

    $allowed_statuses = ['new', 'current', 'final'];
    if (in_array($new_status, $allowed_statuses) && $eoi_id !== '') {
        $sql = "UPDATE eoi SET states = '$new_status' WHERE job_reference_number = '$eoi_id'";
        if (mysqli_query($conn, $sql)) {
            $message = "<p style='color:green;'>Status updated successfully.</p>";
        } else {
            $message = "<p style='color:red;'>Error updating status: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Invalid status or EOI ID.</p>";
    }
}


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

$allowed_sort = ['job_reference_number', 'first_name', 'last_name', 'states'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sort)
        ? $_GET['sort']
        : 'job_reference_number';

$where = "1=1";

$filter_jobref    = isset($_GET['filter_jobref'])    ? mysqli_real_escape_string($conn, trim($_GET['filter_jobref']))    : '';
$filter_firstname = isset($_GET['filter_firstname']) ? mysqli_real_escape_string($conn, trim($_GET['filter_firstname'])) : '';
$filter_lastname  = isset($_GET['filter_lastname'])  ? mysqli_real_escape_string($conn, trim($_GET['filter_lastname']))  : '';

if ($filter_jobref !== '')    { $where .= " AND job_reference_number = '$filter_jobref'"; }
if ($filter_firstname !== '') { $where .= " AND first_name LIKE '%$filter_firstname%'"; }
if ($filter_lastname !== '')  { $where .= " AND last_name LIKE '%$filter_lastname%'"; }

$sql      = "SELECT * FROM eoi WHERE $where ORDER BY $sort ASC";

if (mysqli_query($conn, "SHOW TABLES LIKE 'eoi'")->num_rows > 0) {
    $result   = mysqli_query($conn, $sql);
    $eoi_rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
} else {
    $eoi_rows = [];
    $message = "<p style='color:orange;'>EOI table not set up yet.</p>";
}
?>

<?= $message ?>

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

<section>
    <h2>EOI Results</h2>
    <?php if (empty($eoi_rows)): ?>
        <p>No EOIs found.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
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
                    <td><?= htmlspecialchars($row['job_reference_number']) ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone_number']) ?></td>
                    <td><?= htmlspecialchars($row['states']) ?></td>
                    <td>
                        <form method="POST" action="manage.php">
                            <input type="hidden" name="eoi_id" value="<?= htmlspecialchars($row['job_reference_number']) ?>">
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

<section>
    <h2>Delete EOIs by Job Reference</h2>
    <form method="POST" action="manage.php"
          onsubmit="return confirm('Are you sure? This cannot be undone.');">
        <label>Job Reference: <input type="text" name="del_jobref" placeholder="e.g. SMC01 or SMC02" required></label>
        <button type="submit" name="delete_eois">Delete All EOIs</button>
    </form>
</section>

</main>
<?php
mysqli_close($conn);
include 'include/footer.inc';
?>
<!-- Help taken from Generative AI -->
</body>
</html>