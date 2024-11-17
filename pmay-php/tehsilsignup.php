<?php
include 'connection.php'; // Include the existing connection file

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the userID and password from the POST request
    $userID = $_POST['userID'];
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($userID) || empty($password)) {
        $message = "Please fill in all required fields.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO ApplicantPWD (UserID, Password, PhoneNumber) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userID, $hashedPassword, $userID); // Assuming PhoneNumber = userID

        if ($stmt->execute()) {
            $message = "Signup successful!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tehsil Signup</title>
    <style>
        /* CSS styling here */
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background-color: #f1f1f1; color: #333; }
        .form-container { width: 100%; max-width: 400px; background-color: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); text-align: center; }
        h2 { color: #333; }
        label { display: block; text-align: left; margin: 10px 0 5px; font-weight: bold; color: #333; }
        input[type="number"], input[type="password"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #004085; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        button:hover { background-color: #002752; }
        .message { color: #004085; margin-top: 10px; font-size: 1em; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tehsil Signup</h2>

        <!-- Display message if set -->
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Signup form -->
        <form id="tehsil-signup-form" method="POST" action="">
            <label for="userID">UserID</label>
            <input type="number" id="userID" name="userID" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="button" onclick="handleFormSubmission()">Sign Up</button>
            <p>Already have an account? <a href="http://localhost:3000/tehsil-login.html">Login</a></p>
        </form>
    </div>

    <script>
        function handleFormSubmission() {
            const userID = document.getElementById('userID').value;
            const password = document.getElementById('password').value;

            if (userID && password) {
                document.getElementById('tehsil-signup-form').submit();
            } else {
                alert("Please fill in all required fields.");
            }
        }
    </script>
</body>
</html>
