<?php
// ============================================
// JOB LISTINGS PAGE - jobs.php
// ============================================
// Displays all available jobs from database.
// Workers can search/filter by skill or location.
// ============================================

$pageTitle = "Find Jobs";

// Include database connection
include 'includes/db.php';

// ---- Handle Search/Filter ----
$searchSkill    = isset($_GET['skill']) ? mysqli_real_escape_string($conn, trim($_GET['skill'])) : '';
$searchLocation = isset($_GET['location']) ? mysqli_real_escape_string($conn, trim($_GET['location'])) : '';

// Build SQL query with optional filters
$sql = "SELECT * FROM jobs WHERE 1=1";

if (!empty($searchSkill)) {
    $sql .= " AND skill_category LIKE '%$searchSkill%'";
}

if (!empty($searchLocation)) {
    $sql .= " AND location LIKE '%$searchLocation%'";
}

// Order by newest first
$sql .= " ORDER BY created_at DESC";

// Execute query
$result = mysqli_query($conn, $sql);
$totalJobs = mysqli_num_rows($result);

// Include header
include 'includes/header.php';
?>

<!-- ======== PAGE HEADER ======== -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-search"></i> Find Jobs</h1>
        <p>Browse available job opportunities in your area</p>
    </div>
</section>

<!-- ======== JOB LISTINGS ======== -->
<section class="jobs-section">
    <div class="container">

        <!-- ---- Search / Filter Bar ---- -->
        <div class="search-bar" id="search-bar">
            <form action="jobs.php" method="GET" class="search-form" id="search-form">
                <!-- Skill Filter -->
                <div class="search-group">
                    <label for="filter-skill"><i class="fas fa-tools"></i> Skill Category</label>
                    <select id="filter-skill" name="skill" class="form-control">
                        <option value="">All Skills</option>
                        <option value="Plumber" <?php echo $searchSkill == 'Plumber' ? 'selected' : ''; ?>>Plumber</option>
                        <option value="Electrician" <?php echo $searchSkill == 'Electrician' ? 'selected' : ''; ?>>Electrician</option>
                        <option value="Carpenter" <?php echo $searchSkill == 'Carpenter' ? 'selected' : ''; ?>>Carpenter</option>
                        <option value="Painter" <?php echo $searchSkill == 'Painter' ? 'selected' : ''; ?>>Painter</option>
                        <option value="Laborer" <?php echo $searchSkill == 'Laborer' ? 'selected' : ''; ?>>Laborer</option>
                        <option value="Welder" <?php echo $searchSkill == 'Welder' ? 'selected' : ''; ?>>Welder</option>
                        <option value="Mason" <?php echo $searchSkill == 'Mason' ? 'selected' : ''; ?>>Mason</option>
                        <option value="Cleaner" <?php echo $searchSkill == 'Cleaner' ? 'selected' : ''; ?>>Cleaner</option>
                    </select>
                </div>

                <!-- Location Filter -->
                <div class="search-group">
                    <label for="filter-location"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <input type="text" 
                           id="filter-location" 
                           name="location" 
                           class="form-control" 
                           placeholder="Enter city or area"
                           value="<?php echo htmlspecialchars($searchLocation); ?>">
                </div>

                <!-- Search Button -->
                <button type="submit" class="btn btn-primary" id="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>

                <!-- Clear Filter -->
                <?php if ($searchSkill || $searchLocation): ?>
                    <a href="jobs.php" class="btn btn-outline btn-sm" id="clear-filter-btn">
                        <i class="fas fa-times"></i> Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- ---- Results Count ---- -->
        <p style="margin-bottom: 20px; color: var(--text-muted); font-size: 0.9rem;">
            <i class="fas fa-briefcase"></i> 
            Showing <strong style="color: var(--text-dark);"><?php echo $totalJobs; ?></strong> job(s)
            <?php if ($searchSkill): ?> for skill "<strong><?php echo htmlspecialchars($searchSkill); ?></strong>"<?php endif; ?>
            <?php if ($searchLocation): ?> in "<strong><?php echo htmlspecialchars($searchLocation); ?></strong>"<?php endif; ?>
        </p>

        <!-- ---- Job Cards Grid ---- -->
        <?php if ($totalJobs > 0): ?>
            <div class="jobs-grid">
                <?php while ($job = mysqli_fetch_assoc($result)): ?>
                    <div class="job-card fade-in">
                        <!-- Card Header -->
                        <div class="job-card-header">
                            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                            <span class="job-badge"><?php echo htmlspecialchars($job['skill_category']); ?></span>
                        </div>

                        <!-- Job Description -->
                        <p><?php echo htmlspecialchars($job['description']); ?></p>

                        <!-- Job Details -->
                        <div class="job-meta">
                            <span>
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($job['location']); ?>
                            </span>
                            <span>
                                <i class="fas fa-phone"></i>
                                <?php echo htmlspecialchars($job['contact']); ?>
                            </span>
                            <span>
                                <i class="fas fa-clock"></i>
                                Posted: <?php echo date('d M Y', strtotime($job['created_at'])); ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <!-- No jobs found -->
            <div class="no-jobs">
                <i class="fas fa-folder-open"></i>
                <h3>No Jobs Found</h3>
                <p>No jobs match your search criteria. Try different filters or check back later.</p>
                <a href="jobs.php" class="btn btn-outline" style="margin-top: 16px;">
                    <i class="fas fa-redo"></i> View All Jobs
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
include 'includes/footer.php';
mysqli_close($conn);
?>
