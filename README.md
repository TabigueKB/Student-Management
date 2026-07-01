# 🎓 Student Management System

A simple **PHP & MySQL CRUD Web Application** built for practicing PHP, MySQL, and Bootstrap before developing a capstone project.

---

# 📌 Features

- User Registration
- User Login
- User Logout
- Dashboard
- Add Student
- View Students
- Edit Student
- Delete Student
- Search Students
- Secure Password Hashing
- Session Authentication
- MySQL Database
- Bootstrap 5 Responsive Design

---

# 🛠 Technologies Used

- PHP 8
- MySQL
- XAMPP
- HTML5
- CSS3
- Bootstrap 5
- Font Awesome
- Visual Studio Code

---

# 📁 Project Structure

```
student management/
│
├── assets/
│   └── css/
│       └── style.css
│
├── config/
│   └── database.php
│
├── login.php
├── register.php
├── dashboard.php
├── students.php
├── create.php
├── edit.php
├── delete.php
├── logout.php
├── database.sql
└── README.md
```

---

# 📥 Requirements

Before running the project, install the following:

- XAMPP
- Visual Studio Code
- Google Chrome (Recommended)

---

# 🚀 Installation Guide

## Step 1

Install **XAMPP**

Download from:

https://www.apachefriends.org

---

## Step 2

Open the XAMPP Control Panel.

Start the following services:

- Apache
- MySQL

Both services should turn **green**.

---

## Step 3

Copy the project folder into the XAMPP **htdocs** directory.

Example:

```
C:\xampp\htdocs\student management\
```

Your project should now be located at:

```
C:\xampp\htdocs\student management
```

---

## Step 4

Open your web browser.

Go to:

```
http://localhost/phpmyadmin
```

---

## Step 5

Create a new database.

Database name:

```
student_management
```

Click **Create**.

---

## Step 6

Select the newly created database.

Click the **Import** tab.

Choose the file:

```
database.sql
```

Click **Go**.

---

## Step 7

After importing, you should have these tables:

```
users
students
```

---

## Step 8

Open the database configuration file.

```
config/database.php
```

Verify the settings:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "student_management";
```

If your MySQL has a password, replace the password value accordingly.

---

## Step 9

Open your browser.

Visit:

```
http://localhost/student%20management/
```

or

```
http://localhost/student%20management/login.php
```

> **Note:** Since your project folder is named **student management** (with a space), the URL uses `%20` to represent the space. To avoid this, you can rename the folder to `student-management` and use `http://localhost/student-management/`.

---

## Step 10

Register a new account.

Click **Register**.

Fill in:

- Full Name
- Email
- Password

Click **Register**.

---

## Step 11

Login using the account you created.

---

## Step 12

You will be redirected to the Dashboard.

From there you can:

- View Dashboard
- View Students
- Add Student
- Edit Student
- Delete Student
- Logout

---

# 📷 Application Flow

```
Register
      │
      ▼
Login
      │
      ▼
Dashboard
      │
      ▼
Student List
      │
      ├────────► Add Student
      │
      ├────────► Edit Student
      │
      └────────► Delete Student
```

---

# 🔒 Security Features

- Password Hashing
- Prepared Statements
- Session Authentication
- Input Validation
- SQL Injection Protection
- HTML Output Escaping

---

# 👨‍💻 CRUD Operations

### Create

Add a new student.

### Read

Display all students.

### Update

Modify an existing student.

### Delete

Remove a student record.

---

# 📚 Learning Objectives

This project demonstrates:

- PHP Basics
- MySQL Database Connectivity
- CRUD Operations
- User Authentication
- Session Management
- Bootstrap Layout
- Prepared Statements
- Form Validation

---

# ⚠ Troubleshooting

## "Not Found"

Ensure the project folder is inside:

```
C:\xampp\htdocs\
```

---

## Database Connection Failed

Check that:

- Apache is running.
- MySQL is running.
- The database name is correct.
- The username and password in `database.php` are correct.

---

## Tables Not Found

Re-import the `database.sql` file into the `student_management` database.

---

## PHP Errors

Enable PHP error reporting temporarily by adding this to the top of your PHP file:

```php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
```

---

# 👨‍🎓 Author

Created as a PHP CRUD practice project for learning web development concepts before building a capstone project.

---

# 📄 License

This project is for educational purposes only.