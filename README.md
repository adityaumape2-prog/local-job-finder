# 🛠️ Local Job Finder for Small Workers

A community engagement web application that connects daily wage workers (plumbers, electricians, carpenters, etc.) with local employers.

---

## 📋 Project Abstract

**Local Job Finder for Small Workers** is a web-based application developed as part of a **Community Engagement Program**. The system addresses the challenge faced by daily wage workers — such as plumbers, electricians, carpenters, painters, and laborers — in finding local job opportunities. The platform enables **workers to register** with their skills and location, while **employers can post job requirements**. Workers can browse, search, and filter available jobs by skill category or location, and directly contact employers. An **admin panel** allows managing all records. Built with **PHP, MySQL, HTML, CSS, and JavaScript**, the application features a clean, responsive interface designed for simplicity and accessibility, making it usable even for individuals with basic digital literacy.

---

## 🗂️ Folder Structure

```
local-job-finder/
│
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   └── js/
│       └── script.js           # Client-side JavaScript
│
├── includes/
│   ├── db.php                  # Database connection
│   ├── header.php              # Common header & navbar
│   └── footer.php              # Common footer
│
├── admin/
│   ├── login.php               # Admin login page
│   ├── dashboard.php           # Admin dashboard (manage jobs/workers)
│   └── logout.php              # Admin logout
│
├── index.php                   # Home page
├── register.php                # Worker registration page
├── post-job.php                # Job posting page (employer)
├── jobs.php                    # Job listings with search/filter
├── contact.php                 # Contact information page
│
├── database.sql                # SQL file to create database & tables
└── README.md                   # This file
```

---

## 🚀 Step-by-Step Setup Instructions (XAMPP/WAMP)

### Prerequisites
- **XAMPP** or **WAMP** installed on your computer
- A modern web browser (Chrome, Firefox, Edge)

### Step 1: Start XAMPP/WAMP
1. Open **XAMPP Control Panel**
2. Start **Apache** (web server)
3. Start **MySQL** (database server)

### Step 2: Copy Project Files
1. Navigate to your XAMPP installation folder (usually `C:\xampp\`)
2. Open the `htdocs` folder
3. Copy the entire `local-job-finder` folder into `htdocs`
4. Final path should be: `C:\xampp\htdocs\local-job-finder\`

### Step 3: Create the Database
1. Open your browser and go to: `http://localhost/phpmyadmin`
2. Click on the **"Import"** tab at the top
3. Click **"Choose File"** and select the `database.sql` file from the project folder
4. Click **"Go"** / **"Import"** to execute the SQL
5. The database `local_job_finder` will be created with all tables and sample data

**Alternative Method:**
1. In phpMyAdmin, click **"New"** in the left sidebar
2. Create a database named `local_job_finder`
3. Select the new database, click **"Import"**, and import `database.sql`

### Step 4: Configure Database Connection (if needed)
- Open `includes/db.php`
- Default settings work with XAMPP out of the box:
  ```php
  $host = "localhost";
  $username = "root";
  $password = "";  // empty for XAMPP
  $database = "local_job_finder";
  ```
- If using WAMP or custom config, update these values accordingly

### Step 5: Run the Application
1. Open your browser
2. Go to: **`http://localhost/local-job-finder/`**
3. The home page should load with the full application

### Step 6: Admin Access
- Navigate to: `http://localhost/local-job-finder/admin/login.php`
- **Username:** `admin`
- **Password:** `admin123`

---

## 📊 ER Diagram (Entity-Relationship)

```
┌─────────────────┐         ┌─────────────────────┐
│     WORKERS     │         │        JOBS          │
├─────────────────┤         ├─────────────────────┤
│ id (PK, AI)     │         │ id (PK, AI)         │
│ name            │         │ title               │
│ phone           │         │ description         │
│ skill           │         │ location            │
│ location        │         │ contact             │
│ created_at      │         │ skill_category      │
└─────────────────┘         │ created_at          │
                            └─────────────────────┘

        ┌─────────────────┐
        │      ADMIN      │
        ├─────────────────┤
        │ id (PK, AI)     │
        │ username        │
        │ password (MD5)  │
        └─────────────────┘

Relationships:
- Workers and Jobs are independent entities
- Workers browse Jobs to find work matching their skills
- Admin manages both Workers and Jobs tables
- Jobs.skill_category links logically to Workers.skill
```

### ER Diagram Description:
- **Workers** entity stores worker profiles with their skills
- **Jobs** entity stores job postings from employers
- **Admin** entity stores login credentials for administrators
- Workers and Jobs share a logical relationship through `skill/skill_category` field
- Both Workers and Jobs are managed by the Admin

---

## 📐 Data Flow Diagrams

### DFD Level 0 (Context Diagram)

```
                    ┌──────────┐
   Worker Info      │          │     Job Listings
  ───────────────►  │  LOCAL   │  ──────────────►
                    │   JOB    │
   Job Details      │  FINDER  │     Search Results
  ───────────────►  │  SYSTEM  │  ──────────────►
                    │          │
                    └──────────┘
                         ▲
    Worker ──────────────┘└────────────── Employer
                         ▲
                         │
                       Admin
                   (manages data)
```

**Description:**
- **Worker** provides registration info and receives job listings
- **Employer** posts job details into the system
- **Admin** manages all data (edit/delete)
- The system processes inputs and produces job listings and search results

### DFD Level 1

```
┌──────────┐     Worker Data      ┌─────────────────┐
│  Worker   │ ──────────────────► │  1.0 Worker     │
│ (Source)  │                     │  Registration   │
└──────────┘                     │  Process        │
                                  └────────┬────────┘
                                           │ Store
                                           ▼
                                  ┌─────────────────┐
                                  │   D1: Workers   │
                                  │   Database      │
                                  └─────────────────┘

┌──────────┐     Job Details      ┌─────────────────┐
│ Employer  │ ──────────────────► │  2.0 Job        │
│ (Source)  │                     │  Posting        │
└──────────┘                     │  Process        │
                                  └────────┬────────┘
                                           │ Store
                                           ▼
                                  ┌─────────────────┐
                                  │   D2: Jobs      │
                                  │   Database      │
                                  └────────┬────────┘
                                           │ Retrieve
                                           ▼
┌──────────┐     Search/Filter    ┌─────────────────┐
│  Worker   │ ──────────────────► │  3.0 Job        │ ──► Job Results
│ (Sink)   │ ◄────────────────── │  Search &       │
└──────────┘    Job Results       │  Display        │
                                  └─────────────────┘

┌──────────┐     Login Info       ┌─────────────────┐
│  Admin    │ ──────────────────► │  4.0 Admin      │
│ (Source)  │ ◄────────────────── │  Management     │
└──────────┘  Dashboard Data      │  Process        │
                                  └────────┬────────┘
                                           │ CRUD
                                           ▼
                                  ┌─────────────────┐
                                  │ D1 & D2:        │
                                  │ Workers & Jobs  │
                                  └─────────────────┘
```

**Level 1 Processes:**
1. **Process 1.0** — Worker Registration: Receives worker data, validates, stores in DB
2. **Process 2.0** — Job Posting: Receives job details from employers, stores in DB
3. **Process 3.0** — Job Search & Display: Retrieves and filters jobs for workers
4. **Process 4.0** — Admin Management: Authentication and CRUD operations on all data

---

## ❓ Viva Questions and Answers

### Q1: What is the purpose of this project?
**A:** The Local Job Finder helps daily wage workers (plumbers, electricians, carpenters, etc.) find local job opportunities by connecting them with employers through a web-based platform. It is part of a Community Engagement Program.

### Q2: What technologies are used in this project?
**A:** The frontend uses HTML, CSS, and JavaScript. The backend is built with PHP. MySQL is used as the database. The project runs on XAMPP/WAMP localhost server with Apache.

### Q3: How does the database connection work?
**A:** The `includes/db.php` file uses PHP's `mysqli_connect()` function to establish a connection to the MySQL server. It takes four parameters: hostname (localhost), username (root), password (empty for XAMPP), and database name (local_job_finder).

### Q4: How is the worker registration handled?
**A:** When a worker fills the registration form and submits it, the data is sent via POST method to `register.php`. The PHP code sanitizes the input using `mysqli_real_escape_string()`, validates the fields, and then inserts the data into the `workers` table using an INSERT SQL query.

### Q5: How does the job search/filter work?
**A:** The `jobs.php` page accepts GET parameters for `skill` and `location`. It builds a dynamic SQL query with WHERE clauses using LIKE operator for partial matching. The results are displayed as job cards in a responsive grid.

### Q6: What is the admin panel used for?
**A:** The admin panel allows an administrator to view all registered workers and job postings, edit existing job posts (update title, description, location, contact), and delete jobs or workers from the database.

### Q7: How is admin authentication implemented?
**A:** Admin login uses PHP sessions. When the admin enters correct credentials, the password is hashed with MD5 and compared against the database. Upon successful login, a session variable `admin_logged_in` is set to `true`. Every admin page checks this session variable — if not set, the user is redirected to the login page.

### Q8: What is `mysqli_real_escape_string()` and why is it used?
**A:** `mysqli_real_escape_string()` is a PHP function that escapes special characters in a string for use in an SQL query. It helps prevent **SQL Injection attacks** by ensuring user input is treated as data, not as executable SQL code.

### Q9: What is the difference between GET and POST methods?
**A:** **GET** sends data through the URL (visible), used for search/filter operations. **POST** sends data in the request body (hidden), used for form submissions like registration and job posting. POST is more secure for sensitive data.

### Q10: How is the website made mobile-friendly?
**A:** The website uses **CSS media queries** (`@media`) to adjust layouts at different screen sizes. The navigation menu becomes a hamburger toggle on mobile. Grid layouts switch from multi-column to single-column. Font sizes and padding are reduced for smaller screens.

### Q11: What are CSS Custom Properties (Variables)?
**A:** CSS Custom Properties (like `--primary: #1a56db`) are reusable values defined in the `:root` selector. They allow centralized theming — changing one variable updates the color everywhere it's used, making maintenance easier.

### Q12: What is XAMPP?
**A:** XAMPP is a free, open-source software package that provides **Apache** (web server), **MySQL/MariaDB** (database), **PHP**, and **Perl** — everything needed to run a PHP web application locally. The name stands for Cross-platform, Apache, MySQL, PHP, Perl.

### Q13: Explain the folder structure of this project.
**A:** The project follows a simple MVC-like structure: `includes/` contains reusable components (database connection, header, footer), `assets/` holds CSS and JavaScript files, `admin/` contains admin-specific pages, and the root contains the main public pages (index, register, post-job, jobs, contact).

### Q14: How would you improve this project?
**A:** Possible improvements include: using prepared statements for better SQL security, adding password hashing with `password_hash()` instead of MD5, implementing user login for workers, adding pagination for job listings, adding image uploads for job posts, implementing email notifications, and using AJAX for form submissions without page reload.

### Q15: What is the role of `session_start()` in PHP?
**A:** `session_start()` initializes or resumes a PHP session. Sessions allow storing user-specific data (like login status) across multiple pages. The data is stored on the server and identified by a unique session ID cookie. It must be called before any HTML output.

---

## 📄 License

This project is created for educational purposes as part of a Community Engagement Program.
