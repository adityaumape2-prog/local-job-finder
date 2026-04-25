<!-- ============================================
     Header Include File
     ============================================
     This file contains the common HTML head section
     and navigation bar. It is included at the top
     of every page for consistency.
     ============================================ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Local Job Finder - Connecting daily wage workers with local employers. Find plumbers, electricians, carpenters and more.">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?>Local Job Finder</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ======== NAVIGATION BAR ======== -->
<nav class="navbar" id="main-navbar">
    <div class="container nav-container">
        <!-- Logo / Brand -->
        <a href="index.php" class="nav-brand">
            <i class="fas fa-briefcase"></i>
            <span>JobFinder</span>
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navigation Links -->
        <ul class="nav-links" id="nav-links">
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="register.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>"><i class="fas fa-user-plus"></i> Register</a></li>
            <li><a href="post-job.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'post-job.php' ? 'active' : ''; ?>"><i class="fas fa-plus-circle"></i> Post Job</a></li>
            <li><a href="jobs.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'jobs.php' ? 'active' : ''; ?>"><i class="fas fa-search"></i> Find Jobs</a></li>
            <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> Contact</a></li>
            <li><a href="admin/login.php" class="nav-btn"><i class="fas fa-lock"></i> Admin</a></li>
        </ul>
    </div>
</nav>

<!-- ======== MAIN CONTENT WRAPPER ======== -->
<main class="main-content">
