<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1); //error testing
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
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $eoi_id     = intval($_POST['eoi_id']);
    $new_status = mysqli_real_escape_string($conn, trim($_POST['new_status']));

    $allowed_statuses = ['New', 'Current', 'Final'];
    if (in_array($new_status, $allowed_statuses) && $eoi_id > 0) {
        $sql = "UPDATE eoi SET status = '$new_status' WHERE id = $eoi_id";
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
        $sql = "DELETE FROM eoi WHERE jobReferenceNumber = '$del_jobref'";
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

$allowed_sort = ['id', 'jobReferenceNumber', 'firstName', 'lastName', 'status'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sort)
        ? $_GET['sort']
        : 'id';

$where = "1=1";

$filter_jobref    = isset($_GET['filter_jobref'])    ? mysqli_real_escape_string($conn, trim($_GET['filter_jobref']))    : '';
$filter_firstname = isset($_GET['filter_firstname']) ? mysqli_real_escape_string($conn, trim($_GET['filter_firstname'])) : '';
$filter_lastname  = isset($_GET['filter_lastname'])  ? mysqli_real_escape_string($conn, trim($_GET['filter_lastname']))  : '';

if ($filter_jobref !== '')    { $where .= " AND jobReferenceNumber = '$filter_jobref'"; }
if ($filter_firstname !== '') { $where .= " AND firstName LIKE '%$filter_firstname%'"; }
if ($filter_lastname !== '')  { $where .= " AND lastName LIKE '%$filter_lastname%'"; }

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
        <label>Job Reference: <input type="text" name="filter_jobref" value="<?= htmlspecialchars($filter_jobref) ?>" placeholder="e.g. J001"></label><br><br>
        <label>First Name: <input type="text" name="filter_firstname" value="<?= htmlspecialchars($filter_firstname) ?>" placeholder="First name"></label><br><br>
        <label>Last Name: <input type="text" name="filter_lastname" value="<?= htmlspecialchars($filter_lastname) ?>" placeholder="Last name"></label><br><br>
        <label>Sort by:
            <select name="sort">
                <option value="id"                 <?= $sort === 'id'                 ? 'selected' : '' ?>>EOI Number</option>
                <option value="jobReferenceNumber" <?= $sort === 'jobReferenceNumber' ? 'selected' : '' ?>>Job Reference</option>
                <option value="firstName"          <?= $sort === 'firstName'          ? 'selected' : '' ?>>First Name</option>
                <option value="lastName"           <?= $sort === 'lastName'           ? 'selected' : '' ?>>Last Name</option>
                <option value="status"             <?= $sort === 'status'             ? 'selected' : '' ?>>Status</option>
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
        <table border = "1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>EOI Number</th>
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
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['jobReferenceNumber']) ?></td>
                    <td><?= htmlspecialchars($row['firstName']) ?></td>
                    <td><?= htmlspecialchars($row['lastName']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phoneNumber']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <form method="POST" action="manage.php">
                            <input type="hidden" name="eoi_id" value="<?= htmlspecialchars($row['id']) ?>">
                            <select name="new_status">
                                <option value="New"     <?= $row['status'] === 'New'     ? 'selected' : '' ?>>New</option>
                                <option value="Current" <?= $row['status'] === 'Current' ? 'selected' : '' ?>>Current</option>
                                <option value="Final"   <?= $row['status'] === 'Final'   ? 'selected' : '' ?>>Final</option>
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
        <label>Job Reference: <input type="text" name="del_jobref" placeholder="e.g. J001" required></label>
        <button type="submit" name="delete_eois">Delete All EOIs</button>
    </form>
</section>

</main>
<?php
mysqli_close($conn);
include 'include/footer.inc';
?>
</body>
</html>