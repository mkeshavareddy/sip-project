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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $activity = $_POST['activity'];

    // Prepare and bind the statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, activity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $activity);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, send email
        $subject = "CSR Activity Registration";
        $message = "Name: " . $name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Contact Number: " . $phone . "\n";
        $message .= "Activity: " . $activity . "\n";

        // Replace "your_email@example.com" with a valid email address
        $from_email = "nikunjredddy@gmail.com";

        // Email headers
        $headers = "From: " . $from_email . "\r\n" .
                   "Reply-To: " . $from_email . "\r\n" .
                   "Return-Path: " . $from_email;

        // Replace "your_email@example.com" with your actual email address
        $to = "reddykeshav807@gmail.com";

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "Registration successful! Thank you for registering for the CSR activity.";
        } else {
            echo "Registration successful, but failed to send the registration email. Please contact support.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
