<?php
// Database connection details
$host = 'localhost'; // Replace with your database host
$db = 'test'; // Replace with your database name
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password (if any)

// Create a new MySQLi object
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO user (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    header("Location: ACTIVITY.html "); // Redirect to csr2.html
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
