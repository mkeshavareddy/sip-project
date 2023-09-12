<!DOCTYPE html>
<html>
<head>
    <title>Donation Confirmation</title>
</head>
<body>
    <h2>Donation Confirmation</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $selectedClothes = $_POST['clothes'];

        echo "<p>Thank you, $name, for your generous donation!</p>";
        echo "<p>You have selected to donate: $selectedClothes</p>";
        echo "<p>An email confirmation has been sent to $email</p>";
    }
    ?>
</body>
</html>
