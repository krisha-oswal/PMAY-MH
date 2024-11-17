<?php
// sanctioner-login.php
require 'connection.php'; // Use your existing connection.php for database credentials

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];
    $password = $_POST['password'];

  

  

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT Password FROM SanctionerPWD WHERE UserID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbPassword);
        $stmt->fetch();

        // Verify the password
        if ($password === $dbPassword) {
            echo json_encode(["status" => "success", "message" => "Login successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Incorrect password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "User not found"]);
    }

    $stmt->close();
    $conn->close();
}
?>
<!-- sanctioner-login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanctioner Login</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="form-container">
        <h2>Sanctioner Login</h2>
        <form id="sanctioner-login-form">
            <label for="userID">userID</label>
            <input type="number" id="userID" required>

            <label for="password">Password</label>
            <input type="password" id="password" required>

            <button type="submit">Login</button>
         
        </form>
    </div>
    <script src="sanctioner-login.js"></script>
</body>
</html>

