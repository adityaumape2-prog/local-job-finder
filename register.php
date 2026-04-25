<?php
// ============================================
// WORKER REGISTRATION PAGE - register.php
// ============================================
// Workers can register by filling in their
// name, phone, skill, and location.
// Data is saved to the 'workers' table.
// ============================================

$pageTitle = "Worker Registration";

// Include database connection
include 'includes/db.php';

// Variable to hold success/error messages
$message = "";
$messageType = "";

// ---- Handle Form Submission ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data and sanitize it
    $name     = mysqli_real_escape_string($conn, trim($_POST['name']));
    $phone    = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $skill    = mysqli_real_escape_string($conn, trim($_POST['skill']));
    $location = mysqli_real_escape_string($conn, trim($_POST['location']));

    // Validate: check that no field is empty
    if (empty($name) || empty($phone) || empty($skill) || empty($location)) {
        $message = "All fields are required. Please fill in every field.";
        $messageType = "error";
    }
    // Validate: phone must be 10 digits
    elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $message = "Phone number must be exactly 10 digits.";
        $messageType = "error";
    }
    else {
        // Insert worker into database
        $sql = "INSERT INTO workers (name, phone, skill, location) 
                VALUES ('$name', '$phone', '$skill', '$location')";

        if (mysqli_query($conn, $sql)) {
            // Success!
            $message = "Registration successful! Welcome aboard, $name. Employers can now find you.";
            $messageType = "success";
        } else {
            // Database error
            $message = "Something went wrong. Please try again later.";
            $messageType = "error";
        }
    }
}

// Include the header
include 'includes/header.php';
?>

<!-- ======== PAGE HEADER ======== -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-user-plus"></i> Worker Registration</h1>
        <p>Register your skills and let employers find you</p>
    </div>
</section>

<!-- ======== REGISTRATION FORM ======== -->
<section class="form-section">
    <div class="container">
        <div class="form-container">

            <!-- Form Header -->
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <h2>Register as a Worker</h2>
                <p>Fill in your details below. It only takes a minute!</p>
            </div>

            <!-- Show success/error message -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>" id="form-alert">
                    <i class="fas fa-<?php echo $messageType == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="register.php" method="POST" id="register-form">

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control" 
                           placeholder="Enter your full name"
                           required
                           value="<?php echo isset($_POST['name']) && $messageType == 'error' ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-phone"></i> Phone Number
                    </label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           class="form-control" 
                           placeholder="Enter 10-digit phone number"
                           required
                           value="<?php echo isset($_POST['phone']) && $messageType == 'error' ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>

                <!-- Skill Field (Dropdown) -->
                <div class="form-group">
                    <label for="skill">
                        <i class="fas fa-tools"></i> Your Skill
                    </label>
                    <select id="skill" name="skill" class="form-control" required>
                        <option value="">-- Select your skill --</option>
                        <option value="Plumber" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Plumber') ? 'selected' : ''; ?>>Plumber</option>
                        <option value="Electrician" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Electrician') ? 'selected' : ''; ?>>Electrician</option>
                        <option value="Carpenter" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Carpenter') ? 'selected' : ''; ?>>Carpenter</option>
                        <option value="Painter" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Painter') ? 'selected' : ''; ?>>Painter</option>
                        <option value="Laborer" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Laborer') ? 'selected' : ''; ?>>Laborer</option>
                        <option value="Welder" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Welder') ? 'selected' : ''; ?>>Welder</option>
                        <option value="Mason" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Mason') ? 'selected' : ''; ?>>Mason</option>
                        <option value="Cleaner" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Cleaner') ? 'selected' : ''; ?>>Cleaner</option>
                        <option value="Gardener" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Gardener') ? 'selected' : ''; ?>>Gardener</option>
                        <option value="Other" <?php echo (isset($_POST['skill']) && $_POST['skill'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <!-- Location Field -->
                <div class="form-group">
                    <label for="location">
                        <i class="fas fa-map-marker-alt"></i> Your Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           class="form-control" 
                           placeholder="Enter your city or area"
                           required
                           value="<?php echo isset($_POST['location']) && $messageType == 'error' ? htmlspecialchars($_POST['location']) : ''; ?>">
                </div>

                <!-- Submit Button -->
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary" id="register-submit-btn">
                        <i class="fas fa-paper-plane"></i> Register Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
mysqli_close($conn);
?>
