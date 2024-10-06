<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    
    require 'vendor/autoload.php'; // Adjust path if necessary
    include 'connection.php'; // Include the connection to your MySQL database

    $client = new Google_Client(); //creates new google client object
    $client->setClientId('client id '); // Replace with your Client ID
    $client->setClientSecret('client secret'); // Replace with your Client Secret
    $client->setRedirectUri('http://localhost/loginpage/google-signin-handler.php'); // Replace with your redirect URI
    $client->addScope('email');
    $client->addScope('profile'); // specify permssions for profile and email

    if (isset($_GET['code'])) {
        // Exchange authorization code for access token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        // Handle token fetch error
        if (isset($token['error'])) {
            echo 'Error fetching access token: ' . $token['error'];
            exit;
        }

        // Clear previous session
        session_unset();
        session_destroy();
        session_start();

        // Store the access token
        $client->setAccessToken($token['access_token']);

        // Get user profile information
        $google_service = new Google_Service_Oauth2($client);
        $user_info = $google_service->userinfo->get();

        // Store new user data in session
        $_SESSION['user_email'] = $user_info->email;
        $_SESSION['user_name'] = $user_info->name;
        $_SESSION['user_image'] = $user_info->picture;
       
        // Check if the user already exists in the database
       
        $email = $user_info->email;
        $name = $user_info->name;
        $image = $user_info->picture;
        

        // Prepare SQL query to check if user exists
        $sql = "SELECT * FROM userdata WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            // If user doesn't exist, insert them into the database
            $insert_sql = "INSERT INTO userdata (username, email, profile_image) VALUES ('$name', '$email', '$image')";
            
            if ($conn->query($insert_sql) === TRUE) {
                echo "New user inserted successfully.";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        } else {
            echo "User already exists in the database.";
        }

        // Redirect to home.php
        header('Location: home.php');
        exit;
    }
?>
