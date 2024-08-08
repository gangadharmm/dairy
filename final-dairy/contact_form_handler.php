<?php
// Database configuration
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "dairy"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        // Redirect to confirmation page with query parameters
        header("Location: confirmation.html?status=success&name=" . urlencode($name) . "&email=" . urlencode($email) . "&message=" . urlencode($message));
    } else {
        // Redirect to confirmation page with error message
        header("Location: confirmation.html?status=error&message=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
}
?>
