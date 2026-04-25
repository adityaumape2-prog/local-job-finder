<?php
// ============================================
// ADMIN LOGIN PAGE - admin/login.php
// ============================================
// Basic admin login with username and password.
// Default credentials: admin / admin123
// Uses PHP sessions for authentication.
// ============================================

session_start();

// If already logged in, go to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$pageTitle = "Admin Login";

// Include database connection
include '../includes/db.php';

$message = "";

// ---- Handle Login Form ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = md5(trim($_POST['password'])); // MD5 hash to match DB

    // Check credentials
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful - set session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid username or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Local Job Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Simple Navbar for Admin -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-briefcase"></i>
            <span>JobFinder</span>
        </a>
        <a href="../index.php" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Back to Site
        </a>
    </div>
</nav>

<main class="main-content">
    <!-- Login Form -->
    <div class="admin-login-container">
        <div class="form-container">
            <div class="form-header">
                <div class="form-icon" style="background: #ede9fe; color: #7c3aed;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2>Admin Login</h2>
                <p>Enter your credentials to access the dashboard</p>
            </div>

            <!-- Error Message -->
            <?php if ($message): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" id="admin-login-form">
                <!-- Username -->
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <input type="text" id="username" name="username" class="form-control" 
                           placeholder="Enter admin username" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="Enter admin password" required>
                </div>

                <!-- Login Button -->
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary" id="admin-login-btn">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>
            </form>

            <p style="text-align: center; margin-top: 20px; font-size: 0.85rem; color: var(--text-muted);">
                <i class="fas fa-info-circle"></i> Default: admin / admin123
            </p>
        </div>
    </div>
</main>

<script src="../assets/js/script.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
