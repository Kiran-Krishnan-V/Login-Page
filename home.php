<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login-username']) && !isset($_SESSION['user_name'])) {
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit;
}

// Get the username from session (from Google Sign-In or regular login)
$username = isset($_SESSION['login-username']) ? $_SESSION['login-username'] : $_SESSION['user_name'];
$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            background-color: #282c34; /* Dark background for contrast */
            color: white; /* White text color */
            font-family: Arial, sans-serif; /* Font style */
            text-align: center; /* Centered text */
            
        }
        h1 {
            color: white; /* Color for the heading */
        }
        p {
            white-space: normal; /* Ensure normal line break behavior */
            margin: 10px 0; /* Add some margin for spacing */
        }
        a {
            color: #61dafb; /* Light blue color for links */
            text-decoration: none; /* Remove underline from links */
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .logout a:hover {
            transform: scale(2.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            font-size:15px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p><?php if ($email): ?>Email: <?php echo htmlspecialchars($email); ?><?php endif; ?></p>
    <p>You have successfully logged in.</p>
    <div class="logout"><p><a href="logout.php"><button>Logout</button></a></p></div>
</body>
</html>
