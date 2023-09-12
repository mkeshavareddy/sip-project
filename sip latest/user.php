<?php
// Initialize session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "123"; // Replace with your MySQL password
$dbname = "database"; // Replace with your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to securely hash the password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// User Registration
if (isset($_POST['login-container'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashedPassword = hashPassword($password);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful. You can now login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
}

// User Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to the appropriate dashboard
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
