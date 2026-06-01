<?php
// session_start() at top of every page that uses sessions 
session_start();

// session_destroy() ends the session during logout 
session_unset();
session_destroy();

// Redirect back to login page
header('Location: login.php');
exit();
?>