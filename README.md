# Login Page Project

This is a simple login page project that allows users to register and login using a web interface.It is built using HTML,CSS,JavaScript for the frontend, and PHP with MySQl for the backend.

## Features
* User Registration
* User Login
* Google OAuth 2.0 Sign-In
* Password hashing for secure storage
* Backend validation using PHP
* Database integration with MySQL
* Responsive design

## Technologies Used
### Frontend:
* HTML5: Markup language for structuring the content
* CSS3: Styling the application for a modern and responsive look
* JavaScript: Client-side validation and interactivity
### Backend:
* PHP: Server-side logic to handle user registration and login
* MySQL: Database to store user credentials
### Tools:
* XAMPP: Local development server (Apache, MySQL, PHP)
* VS Code: Code editor for development

## Prerequisites
Before running the project, make sure you have the following installed:

* XAMPP (or any other PHP and MySQL server)
* MySQL Database
* PHP 7.x or above
* Composer (to manage PHP dependencies)

## Installation and Setup

1. **Clone the Repository:**
 
  ```
  git clone https://github.com/your-username/login-page-project.git
  ```
2. **Move Project to XAMPP Directory:**

     Move the cloned project folder to the htdocs directory inside XAMPP:

  ```
  mv login-page-project /path-to-xampp/htdocs/
  ```

3. **Set Up the Database:**

    Open phpMyAdmin (via XAMPP or manually) and create a new database called login_db.
    Run the SQL script database.sql provided in the project folder to create the necessary tables.
  
  ```
  CREATE DATABASE login_db;
  
  USE login_db;
  
  CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
  );
  ```

4. **Configure Database Connection:**

     Open the config.php file and update the database connection details:

  ```
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
  ```

5. **Install Google Client Library via Composer:**

     Navigate to the project directory and run the following command to install the Google Client Library:

  ```
  composer require google/apiclient:^2.0
  
  ```

6. **Create OAuth 2.0 Credentials in Google Cloud Console:**

     * Go to Google Cloud Console.
     * Create a new project or select an existing project.
     * Navigate to APIs & Services > Credentials and click Create Credentials > OAuth 2.0 Client IDs.
     * Configure your OAuth consent screen and download the Client ID and Client Secret as a JSON file.
     * Move the JSON file to your project folder and rename it credentials.json.

7. **Configure Google OAuth in PHP:**

     Open the login.php file and add the following code to handle Google Sign-In:

  ```
  require_once 'vendor/autoload.php'; // Include Composer autoload
  
  // Create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId('YOUR_CLIENT_ID');
  $client->setClientSecret('YOUR_CLIENT_SECRET');
  $client->setRedirectUri('http://localhost/login-page-project/login.php');
  $client->addScope("email");
  $client->addScope("profile");
  
  if (isset($_GET['code'])) {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      $client->setAccessToken($token);
  
      // Get user profile information
      $google_oauth = new Google_Service_Oauth2($client);
      $google_account_info = $google_oauth->userinfo->get();
      $email = $google_account_info->email;
      $name = $google_account_info->name;
  
      // Proceed with your login/registration logic here
  }
  
  // Generate Google OAuth URL
  $google_sign_in_url = $client->createAuthUrl();
  
  
  ```

8. **Start the XAMPP Services:**

     Launch XAMPP and start Apache and MySQL.

9. **Access the Project:**

     Open your browser and navigate to:

  ```
  http://localhost/login-page-project
  ```

## How It Works

**Registration:**
Users can sign up by providing a username, email, and password. The password is hashed using PHP's password_hash() function before storing it in the MySQL database.

**Login:**
Users can log in by providing their username and password. The password is verified using PHP's password_verify() function.

**Google OAuth Sign-In:**
Users can sign in using their Google account. OAuth 2.0 is implemented with Google APIs, and user information is retrieved from the Google profile.

**Client-side validation:**
JavaScript is used to check form fields before submission.

**Server-side validation:**
PHP ensures that only valid data is submitted to the database.

## License

***This project is open-source and available under the MIT License.***

