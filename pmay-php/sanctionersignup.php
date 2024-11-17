<?php
// sanctioner-signup.php
require 'connection.php'; // Use your existing connection.php for database credentials

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];
    $password = $_POST['password'];

    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the UserID already exists
    $stmt = $conn->prepare("SELECT UserID FROM SanctionerPWD WHERE UserID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "UserID already exists"]);
    } else {
        // Insert the new sanctioner details
        $stmt = $conn->prepare("INSERT INTO SanctionerPWD (UserID, Password) VALUES (?, ?)");
        $stmt->bind_param("is", $userID, $password);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Signup successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Signup failed"]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- sanctioner-signup.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanctioner Signup</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="form-container">
        <h2>Sanctioner Signup</h2>
        <form id="sanctioner-signup-form">
            <label for="userId">userID</label>
            <input type="number" id="userID" required>

            <label for="password">Password</label>
            <input type="password" id="password" required>

            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="sanctionerlogin.html">Login</a></p>
        </form>
    </div>
    <script src="sanctioner-signup.js"></script>
</body>
</html>

