-- ============================================
-- Local Job Finder for Small Workers
-- Database Setup Script
-- ============================================
-- Run this SQL file in phpMyAdmin or MySQL CLI
-- to create the database and required tables.
-- ============================================

-- Create database
CREATE DATABASE IF NOT EXISTS local_job_finder;
USE local_job_finder;

-- ============================================
-- Table: workers
-- Stores registered worker information
-- ============================================
CREATE TABLE IF NOT EXISTS workers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    skill VARCHAR(100) NOT NULL,
    location VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Table: jobs
-- Stores job postings from employers
-- ============================================
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(150) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    skill_category VARCHAR(100) DEFAULT 'General',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Table: admin
-- Stores admin login credentials
-- Default: admin / admin123
-- ============================================
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin (password: admin123)
INSERT INTO admin (username, password) VALUES ('admin', MD5('admin123'));

-- ============================================
-- Sample Data: Workers
-- ============================================
INSERT INTO workers (name, phone, skill, location) VALUES
('Ramesh Kumar', '9876543210', 'Plumber', 'Delhi'),
('Suresh Yadav', '9123456789', 'Electrician', 'Mumbai'),
('Anil Sharma', '9988776655', 'Carpenter', 'Jaipur'),
('Priya Devi', '9876512345', 'Painter', 'Pune'),
('Vikram Singh', '9001122334', 'Laborer', 'Chennai');

-- ============================================
-- Sample Data: Jobs
-- ============================================
INSERT INTO jobs (title, description, location, contact, skill_category) VALUES
('Plumber Needed Urgently', 'Need a plumber to fix kitchen pipes and bathroom leaks. Work for 2 days.', 'Delhi', '9876500001', 'Plumber'),
('Electrician for House Wiring', 'Complete house wiring for a 2BHK flat. Must have experience.', 'Mumbai', '9876500002', 'Electrician'),
('Carpenter for Furniture Work', 'Need a skilled carpenter to make wardrobes and shelves.', 'Jaipur', '9876500003', 'Carpenter'),
('Painter for Office', 'Office walls need repainting. Area is approximately 1500 sq ft.', 'Pune', '9876500004', 'Painter'),
('Daily Wage Labor - Construction', 'Laborers needed for a construction site. Daily wage provided.', 'Chennai', '9876500005', 'Laborer');
