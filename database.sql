CREATE DATABASE IF NOT EXISTS student_management;
USE student_management;

-- STUDENTS TABLE 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- STUDENTS TABLE
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    year_level VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- SAMPLE USER
-- Password = admin123

INSERT INTO users(fullname,email,pass)
VALUES(
    'Administator',
    'admin@gmail.com',
    '$2y$10$J0bY6XQ0tM1fA3uPK7Hf5O6F3z5x2bP0Qj7Y2T6A8fWm5wNQk3YQm'
);