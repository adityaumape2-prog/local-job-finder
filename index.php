<?php
// ============================================
// HOME PAGE - index.php
// ============================================
// The landing page of Local Job Finder.
// Shows hero section, stats, features, and CTA.
// ============================================

$pageTitle = "Home";

// Include database connection to get live counts
include 'includes/db.php';

// Get total workers count
$workerResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM workers");
$workerCount = mysqli_fetch_assoc($workerResult)['total'];

// Get total jobs count
$jobResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM jobs");
$jobCount = mysqli_fetch_assoc($jobResult)['total'];

// Include the header (navbar)
include 'includes/header.php';
?>

<!-- ======== HERO SECTION ======== -->
<section class="hero" id="hero">
    <div class="container">
        <div class="hero-content">
            <!-- Badge -->
            <div class="hero-badge">
                <i class="fas fa-star"></i>
                Community Engagement Program
            </div>

            <!-- Main Heading -->
            <h1>Find Local Jobs <br><span class="highlight">Near You Today</span></h1>

            <!-- Description -->
            <p>Connecting daily wage workers — plumbers, electricians, carpenters, painters — with local employers. Register your skills and start finding work in your community.</p>

            <!-- Call to Action Buttons -->
            <div class="hero-buttons">
                <a href="register.php" class="btn btn-primary" id="hero-register-btn">
                    <i class="fas fa-user-plus"></i> Register as Worker
                </a>
                <a href="jobs.php" class="btn btn-secondary" id="hero-find-jobs-btn">
                    <i class="fas fa-search"></i> Find Jobs
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ======== STATS SECTION ======== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <!-- Stat 1: Workers -->
            <div class="stat-card fade-in">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" data-count="<?php echo $workerCount; ?>"><?php echo $workerCount; ?>+</div>
                <div class="stat-label">Registered Workers</div>
            </div>

            <!-- Stat 2: Jobs -->
            <div class="stat-card fade-in fade-in-delay-1">
                <div class="stat-icon orange">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-number" data-count="<?php echo $jobCount; ?>"><?php echo $jobCount; ?>+</div>
                <div class="stat-label">Jobs Posted</div>
            </div>

            <!-- Stat 3: Skills -->
            <div class="stat-card fade-in fade-in-delay-2">
                <div class="stat-icon green">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="stat-number" data-count="10">10+</div>
                <div class="stat-label">Skill Categories</div>
            </div>

            <!-- Stat 4: Locations -->
            <div class="stat-card fade-in fade-in-delay-3">
                <div class="stat-icon purple">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-number" data-count="15">15+</div>
                <div class="stat-label">Locations Covered</div>
            </div>
        </div>
    </div>
</section>

<!-- ======== SKILLS WE COVER ======== -->
<section class="section" id="skills">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="badge"><i class="fas fa-tools"></i> Our Categories</div>
            <h2>Skills We Cover</h2>
            <p>We connect employers with skilled workers across various trades and professions</p>
        </div>

        <!-- Features Grid -->
        <div class="features-grid">
            <!-- Plumber -->
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-wrench"></i>
                </div>
                <h3>Plumber</h3>
                <p>Pipe fitting, leak repairs, bathroom installations and all plumbing work</p>
            </div>

            <!-- Electrician -->
            <div class="feature-card fade-in fade-in-delay-1">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Electrician</h3>
                <p>Wiring, switch repairs, appliance installation and electrical maintenance</p>
            </div>

            <!-- Carpenter -->
            <div class="feature-card fade-in fade-in-delay-2">
                <div class="feature-icon">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3>Carpenter</h3>
                <p>Furniture making, wood repairs, doors, windows and custom woodwork</p>
            </div>

            <!-- Painter -->
            <div class="feature-card fade-in fade-in-delay-3">
                <div class="feature-icon">
                    <i class="fas fa-paint-roller"></i>
                </div>
                <h3>Painter</h3>
                <p>Wall painting, house renovation, texture work and decorative finishes</p>
            </div>

            <!-- Laborer -->
            <div class="feature-card fade-in fade-in-delay-4">
                <div class="feature-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3>Laborer</h3>
                <p>Construction work, loading, shifting and general manual labor tasks</p>
            </div>

            <!-- More Skills -->
            <div class="feature-card fade-in fade-in-delay-4">
                <div class="feature-icon">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <h3>And More</h3>
                <p>Welders, masons, cleaners, gardeners and many more skilled trades</p>
            </div>
        </div>
    </div>
</section>

<!-- ======== HOW IT WORKS ======== -->
<section class="section" style="background: var(--bg-white);" id="how-it-works">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="badge"><i class="fas fa-info-circle"></i> Simple Process</div>
            <h2>How It Works</h2>
            <p>Three simple steps to connect workers with employers</p>
        </div>

        <!-- Steps -->
        <div class="steps-grid">
            <!-- Step 1 -->
            <div class="step-card fade-in">
                <div class="step-number">1</div>
                <h3>Register Your Skills</h3>
                <p>Workers sign up with their name, phone, skill type and location — it takes just a minute!</p>
            </div>

            <!-- Step 2 -->
            <div class="step-card fade-in fade-in-delay-1">
                <div class="step-number">2</div>
                <h3>Employers Post Jobs</h3>
                <p>Employers post job requirements with description, location and contact details</p>
            </div>

            <!-- Step 3 -->
            <div class="step-card fade-in fade-in-delay-2">
                <div class="step-number">3</div>
                <h3>Connect & Work</h3>
                <p>Workers browse jobs, find matching opportunities and contact employers directly</p>
            </div>
        </div>
    </div>
</section>

<!-- ======== CTA SECTION ======== -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Join our community today — whether you're looking for work or looking to hire skilled workers</p>
        <div class="cta-buttons">
            <a href="register.php" class="btn btn-primary" id="cta-register-btn">
                <i class="fas fa-user-plus"></i> Register Now
            </a>
            <a href="post-job.php" class="btn btn-secondary" id="cta-post-job-btn">
                <i class="fas fa-plus-circle"></i> Post a Job
            </a>
        </div>
    </div>
</section>

<?php
// Include the footer
include 'includes/footer.php';

// Close database connection
mysqli_close($conn);
?>
