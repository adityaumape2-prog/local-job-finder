/* ============================================
   Local Job Finder - JavaScript
   ============================================
   Handles: navigation toggle, scroll effects,
   form validation, and UI interactions.
   ============================================ */

// ======== MOBILE NAV TOGGLE ========
// Show/hide the navigation menu on mobile devices
const navToggle = document.getElementById('nav-toggle');
const navLinks = document.getElementById('nav-links');

if (navToggle) {
    navToggle.addEventListener('click', function () {
        navLinks.classList.toggle('active');
        // Change icon between bars and X
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
}

// ======== NAVBAR SCROLL EFFECT ========
// Add shadow to navbar when user scrolls down
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

// ======== CLOSE NAV ON LINK CLICK (Mobile) ========
// When a nav link is clicked on mobile, close the menu
document.querySelectorAll('.nav-links a').forEach(function (link) {
    link.addEventListener('click', function () {
        if (navLinks) {
            navLinks.classList.remove('active');
        }
        if (navToggle) {
            const icon = navToggle.querySelector('i');
            icon.classList.add('fa-bars');
            icon.classList.remove('fa-times');
        }
    });
});

// ======== FORM VALIDATION ========
// Basic client-side validation for forms
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let isValid = true;
    const inputs = form.querySelectorAll('.form-control[required]');

    inputs.forEach(function (input) {
        // Remove previous error styling
        input.style.borderColor = '';

        if (input.value.trim() === '') {
            input.style.borderColor = '#dc2626';
            isValid = false;
        }
    });

    if (!isValid) {
        // Show alert if validation fails
        alert('Please fill in all required fields.');
    }

    return isValid;
}

// ======== PHONE NUMBER VALIDATION ========
// Allow only numbers in phone fields
document.querySelectorAll('input[type="tel"], input[name="phone"], input[name="contact"]').forEach(function (input) {
    input.addEventListener('input', function () {
        // Remove any non-digit characters
        this.value = this.value.replace(/[^0-9]/g, '');
        // Limit to 10 digits
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
});

// ======== AUTO-HIDE ALERTS ========
// Automatically hide success/error messages after 5 seconds
// Only target alerts that are currently visible (not hidden template alerts)
const alerts = document.querySelectorAll('.alert');
alerts.forEach(function (alertEl) {
    // Skip hidden alerts — they are templates shown dynamically by form handlers
    if (alertEl.style.display === 'none') return;
    
    setTimeout(function () {
        alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        alertEl.style.opacity = '0';
        alertEl.style.transform = 'translateY(-10px)';
        setTimeout(function () {
            alertEl.style.display = 'none';
            alertEl.style.opacity = '1';
            alertEl.style.transform = '';
        }, 500);
    }, 5000);
});

// ======== SCROLL ANIMATION (Fade In) ========
// Animate elements into view as user scrolls
function animateOnScroll() {
    const elements = document.querySelectorAll('.fade-in-scroll');

    elements.forEach(function (el) {
        const rect = el.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (rect.top < windowHeight - 80) {
            el.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);

// ======== COUNTER ANIMATION ========
// Animate numbers counting up on the home page
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number');

    counters.forEach(function (counter) {
        const target = parseInt(counter.getAttribute('data-count'));
        if (!target) return;

        let current = 0;
        const increment = Math.max(1, Math.floor(target / 40));
        const duration = 1500; // milliseconds
        const stepTime = duration / (target / increment);

        const timer = setInterval(function () {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = current + '+';
        }, stepTime);
    });
}

// Run counter animation when stats section is visible
const statsSection = document.querySelector('.stats-section');
if (statsSection) {
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    observer.observe(statsSection);
}

// ======== SMOOTH SCROLL FOR ANCHOR LINKS ========
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        // Skip bare '#' links (used for SPA navigation via onclick handlers)
        if (!href || href === '#') return;
        e.preventDefault();
        try {
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        } catch (err) {
            // Invalid selector, ignore
        }
    });
});
