<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['signup-username']) && isset($_POST['signup-email']) && isset($_POST['signup-password'])) {
        $username = $_POST['signup-username'];
        $email = $_POST['signup-email'];
        $password = password_hash($_POST['signup-password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "User Registered Successfully";
        } else {
            echo "ERROR: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
?>