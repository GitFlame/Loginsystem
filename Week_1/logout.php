<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page with a query parameter to indicate successful logout
header('location: index.php?logout');
?>
