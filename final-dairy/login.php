<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "dairy"; // Use the specified database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hashed_password);
$stmt->fetch();

// Verify password and check if user exists
if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $id;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

// Close connections
$stmt->close();
$conn->close();
?>
