<?php
// ============================================
// ADMIN LOGOUT - admin/logout.php
// ============================================
// Destroys the admin session and redirects
// back to the login page.
// ============================================

session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>
