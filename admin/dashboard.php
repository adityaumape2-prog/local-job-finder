<?php
// ============================================
// ADMIN DASHBOARD - admin/dashboard.php
// ============================================
// Protected page showing all workers and jobs.
// Admin can edit and delete job posts.
// Requires login via session check.
// ============================================

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$pageTitle = "Admin Dashboard";

// Include database connection
include '../includes/db.php';

$message = "";
$messageType = "";

// ---- Handle Delete Job ----
if (isset($_GET['delete_job'])) {
    $jobId = intval($_GET['delete_job']);
    $sql = "DELETE FROM jobs WHERE id = $jobId";
    if (mysqli_query($conn, $sql)) {
        $message = "Job deleted successfully!";
        $messageType = "success";
    } else {
        $message = "Error deleting job.";
        $messageType = "error";
    }
}

// ---- Handle Delete Worker ----
if (isset($_GET['delete_worker'])) {
    $workerId = intval($_GET['delete_worker']);
    $sql = "DELETE FROM workers WHERE id = $workerId";
    if (mysqli_query($conn, $sql)) {
        $message = "Worker deleted successfully!";
        $messageType = "success";
    } else {
        $message = "Error deleting worker.";
        $messageType = "error";
    }
}

// ---- Handle Edit Job (POST) ----
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_job_id'])) {
    $editId    = intval($_POST['edit_job_id']);
    $editTitle = mysqli_real_escape_string($conn, trim($_POST['edit_title']));
    $editDesc  = mysqli_real_escape_string($conn, trim($_POST['edit_description']));
    $editLoc   = mysqli_real_escape_string($conn, trim($_POST['edit_location']));
    $editCont  = mysqli_real_escape_string($conn, trim($_POST['edit_contact']));

    $sql = "UPDATE jobs SET title='$editTitle', description='$editDesc', 
            location='$editLoc', contact='$editCont' WHERE id=$editId";

    if (mysqli_query($conn, $sql)) {
        $message = "Job updated successfully!";
        $messageType = "success";
    } else {
        $message = "Error updating job.";
        $messageType = "error";
    }
}

// ---- Fetch all jobs ----
$jobs = mysqli_query($conn, "SELECT * FROM jobs ORDER BY created_at DESC");
$totalJobs = mysqli_num_rows($jobs);

// ---- Fetch all workers ----
$workers = mysqli_query($conn, "SELECT * FROM workers ORDER BY created_at DESC");
$totalWorkers = mysqli_num_rows($workers);

// ---- Check if editing a job ----
$editingJob = null;
if (isset($_GET['edit_job'])) {
    $editJobId = intval($_GET['edit_job']);
    $editResult = mysqli_query($conn, "SELECT * FROM jobs WHERE id=$editJobId");
    if (mysqli_num_rows($editResult) == 1) {
        $editingJob = mysqli_fetch_assoc($editResult);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Local Job Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-briefcase"></i>
            <span>JobFinder</span>
        </a>
        <div style="display: flex; align-items: center; gap: 14px;">
            <span style="font-size: 0.9rem; color: var(--text-muted);">
                <i class="fas fa-user-shield"></i> 
                <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</nav>

<main class="main-content">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
            <p>Manage workers and job postings</p>
        </div>
    </section>

    <section class="admin-dashboard">
        <div class="container">

            <!-- Success/Error Messages -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>">
                    <i class="fas fa-<?php echo $messageType == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Stats Summary -->
            <div class="stats-grid" style="margin-bottom: 40px;">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-briefcase"></i></div>
                    <div class="stat-number"><?php echo $totalJobs; ?></div>
                    <div class="stat-label">Total Jobs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-users"></i></div>
                    <div class="stat-number"><?php echo $totalWorkers; ?></div>
                    <div class="stat-label">Total Workers</div>
                </div>
            </div>

            <!-- ---- Edit Job Form (shown when editing) ---- -->
            <?php if ($editingJob): ?>
                <div class="form-container" style="margin-bottom: 40px; max-width: 100%;">
                    <div class="form-header">
                        <h2><i class="fas fa-edit"></i> Edit Job #<?php echo $editingJob['id']; ?></h2>
                    </div>
                    <form action="dashboard.php" method="POST">
                        <input type="hidden" name="edit_job_id" value="<?php echo $editingJob['id']; ?>">
                        <div class="form-group">
                            <label for="edit_title"><i class="fas fa-heading"></i> Job Title</label>
                            <input type="text" id="edit_title" name="edit_title" class="form-control" 
                                   value="<?php echo htmlspecialchars($editingJob['title']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description"><i class="fas fa-align-left"></i> Description</label>
                            <textarea id="edit_description" name="edit_description" class="form-control" 
                                      required><?php echo htmlspecialchars($editingJob['description']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_location"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <input type="text" id="edit_location" name="edit_location" class="form-control" 
                                   value="<?php echo htmlspecialchars($editingJob['location']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_contact"><i class="fas fa-phone"></i> Contact</label>
                            <input type="text" id="edit_contact" name="edit_contact" class="form-control" 
                                   value="<?php echo htmlspecialchars($editingJob['contact']); ?>" required>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="dashboard.php" class="btn btn-outline">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- ---- JOBS TABLE ---- -->
            <div class="admin-table-wrap">
                <div class="admin-table-header">
                    <h3><i class="fas fa-briefcase"></i> Job Postings (<?php echo $totalJobs; ?>)</h3>
                    <a href="../post-job.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Job
                    </a>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($totalJobs > 0): ?>
                            <?php while ($job = mysqli_fetch_assoc($jobs)): ?>
                                <tr>
                                    <td><?php echo $job['id']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($job['title']); ?></strong></td>
                                    <td><span class="job-badge"><?php echo htmlspecialchars($job['skill_category']); ?></span></td>
                                    <td><?php echo htmlspecialchars($job['location']); ?></td>
                                    <td><?php echo htmlspecialchars($job['contact']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($job['created_at'])); ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="dashboard.php?edit_job=<?php echo $job['id']; ?>" 
                                               class="btn btn-outline btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="dashboard.php?delete_job=<?php echo $job['id']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this job?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-muted);">
                                    No jobs posted yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- ---- WORKERS TABLE ---- -->
            <div class="admin-table-wrap">
                <div class="admin-table-header">
                    <h3><i class="fas fa-users"></i> Registered Workers (<?php echo $totalWorkers; ?>)</h3>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Skill</th>
                            <th>Location</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($totalWorkers > 0): ?>
                            <?php while ($worker = mysqli_fetch_assoc($workers)): ?>
                                <tr>
                                    <td><?php echo $worker['id']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($worker['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($worker['phone']); ?></td>
                                    <td><span class="job-badge"><?php echo htmlspecialchars($worker['skill']); ?></span></td>
                                    <td><?php echo htmlspecialchars($worker['location']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($worker['created_at'])); ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="dashboard.php?delete_worker=<?php echo $worker['id']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this worker?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-muted);">
                                    No workers registered yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>

<script src="../assets/js/script.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
