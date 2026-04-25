<?php
// ============================================
// CONTACT PAGE - contact.php
// ============================================
// Shows how workers can contact employers
// and provides project contact information.
// ============================================

$pageTitle = "Contact Us";

// Include header
include 'includes/header.php';
?>

<!-- ======== PAGE HEADER ======== -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-envelope"></i> Contact Us</h1>
        <p>Get in touch with us — we're here to help</p>
    </div>
</section>

<!-- ======== CONTACT SECTION ======== -->
<section class="section">
    <div class="container">
        <div class="contact-grid">

            <!-- ---- Contact Information Cards ---- -->
            <div class="contact-info-cards">
                <!-- How to Connect -->
                <div class="contact-card fade-in">
                    <div class="contact-card-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div>
                        <h4>How Workers Connect with Employers</h4>
                        <p>Browse the job listings page, find a matching job, and call the employer directly using the contact number provided in each listing.</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="contact-card fade-in fade-in-delay-1">
                    <div class="contact-card-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <h4>Phone / WhatsApp</h4>
                        <p>+91 98765 43210<br>Available Mon - Sat, 9:00 AM to 6:00 PM</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="contact-card fade-in fade-in-delay-2">
                    <div class="contact-card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4>Email Us</h4>
                        <p>help@jobfinder.local<br>We'll respond within 24 hours</p>
                    </div>
                </div>

                <!-- Address -->
                <div class="contact-card fade-in fade-in-delay-3">
                    <div class="contact-card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4>Visit Our Office</h4>
                        <p>Community Center, Main Road<br>Near Bus Stand, City - 110001</p>
                    </div>
                </div>

                <!-- Working Hours -->
                <div class="contact-card fade-in fade-in-delay-4">
                    <div class="contact-card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h4>Working Hours</h4>
                        <p>Monday to Saturday: 9:00 AM - 6:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>
            </div>

            <!-- ---- FAQ / Tips Section ---- -->
            <div class="form-container" style="margin: 0;">
                <div class="form-header">
                    <div class="form-icon" style="background: var(--accent-light); color: var(--accent-dark);">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h2>Frequently Asked Questions</h2>
                    <p>Common questions from workers and employers</p>
                </div>

                <!-- FAQ Items -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <h4 style="color: var(--text-dark); font-size: 0.95rem; margin-bottom: 6px;">
                            <i class="fas fa-chevron-right" style="color: var(--primary); margin-right: 8px; font-size: 0.8rem;"></i>
                            Is registration free for workers?
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; padding-left: 24px;">
                            Yes! Registration is completely free. Workers can sign up and browse all job listings at no cost.
                        </p>
                    </div>

                    <div>
                        <h4 style="color: var(--text-dark); font-size: 0.95rem; margin-bottom: 6px;">
                            <i class="fas fa-chevron-right" style="color: var(--primary); margin-right: 8px; font-size: 0.8rem;"></i>
                            How do I contact an employer?
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; padding-left: 24px;">
                            Each job listing shows the employer's contact number. Simply call or WhatsApp them directly.
                        </p>
                    </div>

                    <div>
                        <h4 style="color: var(--text-dark); font-size: 0.95rem; margin-bottom: 6px;">
                            <i class="fas fa-chevron-right" style="color: var(--primary); margin-right: 8px; font-size: 0.8rem;"></i>
                            How do I post a job?
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; padding-left: 24px;">
                            Go to the "Post Job" page, fill in the job details including title, description, location and your contact number, then click submit.
                        </p>
                    </div>

                    <div>
                        <h4 style="color: var(--text-dark); font-size: 0.95rem; margin-bottom: 6px;">
                            <i class="fas fa-chevron-right" style="color: var(--primary); margin-right: 8px; font-size: 0.8rem;"></i>
                            Can I edit or delete my job post?
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; padding-left: 24px;">
                            Currently, only the admin can edit or delete job posts. Contact us if you need changes to your listing.
                        </p>
                    </div>

                    <div>
                        <h4 style="color: var(--text-dark); font-size: 0.95rem; margin-bottom: 6px;">
                            <i class="fas fa-chevron-right" style="color: var(--primary); margin-right: 8px; font-size: 0.8rem;"></i>
                            Which areas do you cover?
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; padding-left: 24px;">
                            We cover multiple cities and towns. Workers and employers from any location can register and post jobs.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>
