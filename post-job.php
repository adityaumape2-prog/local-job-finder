<?php
// ============================================
// JOB POSTING PAGE - post-job.php
// ============================================
// Employers can post job opportunities by
// filling in job details. Data is saved
// to the 'jobs' table in the database.
// ============================================

$pageTitle = "Post a Job";

// Include database connection
include 'includes/db.php';

// Variable to hold success/error messages
$message = "";
$messageType = "";

// ---- Handle Form Submission ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data and sanitize
    $title       = mysqli_real_escape_string($conn, trim($_POST['title']));
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));
    $location    = mysqli_real_escape_string($conn, trim($_POST['location']));
    $contact     = mysqli_real_escape_string($conn, trim($_POST['contact']));
    $skill_cat   = mysqli_real_escape_string($conn, trim($_POST['skill_category']));

    // Validate: all fields required
    if (empty($title) || empty($description) || empty($location) || empty($contact)) {
        $message = "All fields are required. Please fill in every field.";
        $messageType = "error";
    }
    // Validate: contact must be 10 digits
    elseif (!preg_match('/^[0-9]{10}$/', $contact)) {
        $message = "Contact number must be exactly 10 digits.";
        $messageType = "error";
    }
    else {
        // Insert job into database
        $sql = "INSERT INTO jobs (title, description, location, contact, skill_category) 
                VALUES ('$title', '$description', '$location', '$contact', '$skill_cat')";

        if (mysqli_query($conn, $sql)) {
            $message = "Job posted successfully! Workers can now see your listing.";
            $messageType = "success";
        } else {
            $message = "Something went wrong. Please try again later.";
            $messageType = "error";
        }
    }
}

// Include header
include 'includes/header.php';
?>

<!-- ======== PAGE HEADER ======== -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-plus-circle"></i> Post a Job</h1>
        <p>Help workers find opportunities — post your job requirement</p>
    </div>
</section>

<!-- ======== JOB POSTING FORM ======== -->
<section class="form-section">
    <div class="container">
        <div class="form-container">

            <!-- Form Header -->
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h2>Post a New Job</h2>
                <p>Fill in the job details for workers to find</p>
            </div>

            <!-- Show success/error message -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>" id="form-alert">
                    <i class="fas fa-<?php echo $messageType == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Job Form -->
            <form action="post-job.php" method="POST" id="post-job-form">

                <!-- Job Title -->
                <div class="form-group">
                    <label for="title">
                        <i class="fas fa-heading"></i> Job Title
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           class="form-control" 
                           placeholder="e.g., Plumber Needed for House"
                           required
                           value="<?php echo isset($_POST['title']) && $messageType == 'error' ? htmlspecialchars($_POST['title']) : ''; ?>">
                </div>

                <!-- Skill Category -->
                <div class="form-group">
                    <label for="skill_category">
                        <i class="fas fa-tags"></i> Skill Category
                    </label>
                    <select id="skill_category" name="skill_category" class="form-control" required>
                        <option value="General">-- Select category --</option>
                        <option value="Plumber" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Plumber') ? 'selected' : ''; ?>>Plumber</option>
                        <option value="Electrician" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Electrician') ? 'selected' : ''; ?>>Electrician</option>
                        <option value="Carpenter" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Carpenter') ? 'selected' : ''; ?>>Carpenter</option>
                        <option value="Painter" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Painter') ? 'selected' : ''; ?>>Painter</option>
                        <option value="Laborer" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Laborer') ? 'selected' : ''; ?>>Laborer</option>
                        <option value="Welder" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Welder') ? 'selected' : ''; ?>>Welder</option>
                        <option value="Mason" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Mason') ? 'selected' : ''; ?>>Mason</option>
                        <option value="Cleaner" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Cleaner') ? 'selected' : ''; ?>>Cleaner</option>
                        <option value="Other" <?php echo (isset($_POST['skill_category']) && $_POST['skill_category'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <!-- Job Description -->
                <div class="form-group">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Job Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              class="form-control" 
                              placeholder="Describe the job in detail — what work is needed, duration, pay etc."
                              required><?php echo isset($_POST['description']) && $messageType == 'error' ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                </div>

                <!-- Location -->
                <div class="form-group">
                    <label for="location">
                        <i class="fas fa-map-marker-alt"></i> Job Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           class="form-control" 
                           placeholder="Enter city or area where work is needed"
                           required
                           value="<?php echo isset($_POST['location']) && $messageType == 'error' ? htmlspecialchars($_POST['location']) : ''; ?>">
                </div>

                <!-- Contact Number -->
                <div class="form-group">
                    <label for="contact">
                        <i class="fas fa-phone"></i> Contact Number
                    </label>
                    <input type="tel" 
                           id="contact" 
                           name="contact" 
                           class="form-control" 
                           placeholder="Enter 10-digit contact number"
                           required
                           value="<?php echo isset($_POST['contact']) && $messageType == 'error' ? htmlspecialchars($_POST['contact']) : ''; ?>">
                </div>

                <!-- Submit Button -->
                <div class="form-submit">
                    <button type="submit" class="btn btn-success" id="post-job-submit-btn">
                        <i class="fas fa-paper-plane"></i> Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
mysqli_close($conn);
?>
