-- SQL schema matched to the uploaded Attendance Management System PHP code.
-- Database name must match Includes/dbconn.php: attendancesystem
-- Login code in index.php hashes passwords with MD5.

CREATE DATABASE IF NOT EXISTS attendancesystem
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE attendancesystem;

CREATE TABLE IF NOT EXISTS tbladmin (
  Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(100) NOT NULL,
  lastName VARCHAR(100) NOT NULL,
  emailAddress VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (Id),
  UNIQUE KEY uq_tbladmin_email (emailAddress)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS class (
  Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  className VARCHAR(100) NOT NULL,
  PRIMARY KEY (Id),
  UNIQUE KEY uq_class_name (className)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tblclassteacher (
  Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(100) NOT NULL,
  lastName VARCHAR(100) NOT NULL,
  emailAddress VARCHAR(255) NOT NULL,
  phoneNo VARCHAR(30) DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  className VARCHAR(100) DEFAULT NULL,
  classId INT UNSIGNED DEFAULT NULL,
  classArmId INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (Id),
  UNIQUE KEY uq_tblclassteacher_email (emailAddress)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student (
  Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(100) NOT NULL,
  lastName VARCHAR(100) NOT NULL,
  admissionNo VARCHAR(50) NOT NULL,
  className VARCHAR(100) NOT NULL,
  PRIMARY KEY (Id),
  UNIQUE KEY uq_student_admissionNo (admissionNo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS attendance6 (
  Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  student_name VARCHAR(100) NOT NULL,
  attendance_date DATE NOT NULL,
  attendance_time TIME NOT NULL,
  status ENUM('present','absent','late','excused') NOT NULL DEFAULT 'absent',
  PRIMARY KEY (Id),
  KEY idx_attendance6_date (attendance_date),
  KEY idx_attendance6_student_name (student_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Demo administrator for local testing:
-- Email: admin@example.com
-- Password: admin123
-- The PHP code uses MD5, so this hash matches md5('admin123').
INSERT IGNORE INTO tbladmin (firstName, lastName, emailAddress, password)
VALUES ('Admin', 'User', 'admin@example.com', MD5('admin123'));

-- Optional demo class and student (safe to re-run due to unique class/admission values).
INSERT IGNORE INTO class (className) VALUES ('Demo Class');
INSERT IGNORE INTO student (firstName, lastName, admissionNo, className)
VALUES ('Demo', 'Student', 'DEMO001', 'Demo Class');

-- Teachers created in Admin/createClassTeacher.php receive password: pass123.
-- You can create a teacher after logging in as the administrator.
