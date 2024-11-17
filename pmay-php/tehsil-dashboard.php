<?php
// Start the session
session_start();

// Check if the user is logged in; otherwise, redirect to the login page
if (!isset($_SESSION['userID'])) {
    header("Location: tehsil-login.php");
    exit;
}

// Include database connection (optional if you want to use it for more functionalities)
include 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tehsil Dashboard</title>
    <style>
        /* Inline CSS for styling */
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f1f1f1; }
        .dashboard-container { text-align: center; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); max-width: 400px; }
        h1 { color: #004085; }
        p { font-size: 1.2em; color: #333; }
        .dashboard-buttons { margin-top: 20px; }
        button { padding: 10px 20px; font-size: 1em; margin: 10px; background-color: #004085; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #002752; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to the Tehsil Dashboard</h1>
        <p>You have successfully logged in as a Tehsil user!</p>
        
        <!-- Tehsil-specific functionalities here -->
        <div class="dashboard-buttons">
            <button onclick="window.location.href='tehsilapplicationapproval.php'">Manage Applications</button>
            <button onclick="window.location.href='view-reports.php'">View Reports</button>
            <button onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>
</body>
</html>
