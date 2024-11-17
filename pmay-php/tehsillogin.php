<?php
// tehsil-login.php
require 'connection.php'; // Reuse your connection.php for database credentials

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];

    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the Phone Number and Password match
    $stmt = $conn->prepare("SELECT PhoneNumber FROM TehsilPWD WHERE PhoneNumber = ? AND Password = ?");
    $stmt->bind_param("is", $phoneNumber, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid phone number or password"]);
    }

    $stmt->close();
    $conn->close();
}
?>
