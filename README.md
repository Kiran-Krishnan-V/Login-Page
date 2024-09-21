Login Page Project

This is a simple login page project that allows users to register and log in using a web interface. It is built using HTML, CSS, JavaScript for the frontend, and PHP with MySQL for the backend.

##Features

-User Registration

-User Login

-Password hashing for secure storage

-Backend validation using PHP

-Database integration with MySQL

-Responsive design

##Technologies Used

*Frontend:

   -HTML5: Markup language for structuring the content
  
   -CSS3: Styling the application for a modern and responsive look
  
   -JavaScript: Client-side validation and interactivity
    
*Backend:

  -PHP: Server-side logic to handle user registration and login
  
  -MySQL: Database to store user credentials
    
*Tools:

  -XAMPP: Local development server (Apache, MySQL, PHP)
  
  -VS Code: Code editor for development

##Prerequisites

Before running the project, make sure you have the following installed:

-XAMPP (or any other PHP and MySQL server)

-MySQL Database

-PHP 7.x or above

##Installation and Setup

1.Clone the Repository:
     
     git clone https://github.com/your-username/login-page-project.git

2.Move Project to XAMPP Directory:
Move the cloned project folder to the htdocs directory inside XAMPP:
     
     mv login-page-project /path-to-xampp/htdocs/

3.Set Up the Database:
-Open phpMyAdmin (via XAMPP or manually) and create a new database called login_db.
-Run the SQL script database.sql provided in the project folder to create the necessary tables.

  
    CREATE DATABASE login_db;

    USE login_db;

    CREATE TABLE users (
     id INT(11) AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(50) NOT NULL UNIQUE,
     email VARCHAR(100) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL
    );

4.Configure Database Connection:
Open the config.php file and update the database connection details:

  
    <?php
    $host = 'localhost';
    $db = 'login_db';
    $user = 'root'; // Update if using different user
    $pass = '';     // Update if using a password
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    ?>

5.Start the XAMPP Services:
Launch XAMPP and start Apache and MySQL.

6.Access the Project:
Open your browser and navigate to:

    http://localhost/login-page-project

##How It Works

-Registration: Users can sign up by providing a username, email, and password. The password is hashed using PHP's password_hash() function before storing it in the MySQL database.

-Login: Users can log in by providing their username and password. The password is verified using PHP's password_verify() function.

-Client-side validation: JavaScript is used to check form fields before submission.

-Server-side validation: PHP ensures that only valid data is submitted to the database.

##License

This project is open-source and available under the MIT License.







