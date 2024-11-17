<?php
// Include the database connection file
require_once 'connection.php';

// Initialize the response message variable
$responseMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $managerName = $_POST['managerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $assignedProject = $_POST['assignedProject'];

    // Check if the fields are not empty
    if (empty($managerName) || empty($phoneNumber) || empty($email) || empty($assignedProject)) {
        $responseMessage = 'All fields are required.';
    } else {
        // Prepare SQL query to insert the project manager data
        $sql = "INSERT INTO ProjectManagers (ManagerName, PhoneNumber, Email, AssignedProject) VALUES (?, ?, ?, ?)";

        // Prepare and execute the query
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssss", $managerName, $phoneNumber, $email, $assignedProject);

            // Execute the query
            if ($stmt->execute()) {
                $responseMessage = 'Project Manager added successfully!';
            } else {
                $responseMessage = 'Error: Could not execute the query. ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $responseMessage = 'Error: Could not prepare the query. ' . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Project Manager</h1>
        <form id="addProjectManagerForm" method="POST">
            <div class="form-group">
                <label for="managerName">Manager Name:</label>
                <input type="text" id="managerName" name="managerName" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="assignedProject">Assigned Project:</label>
                <input type="text" id="assignedProject" name="assignedProject" required>
            </div>
            <button type="submit">Add Project Manager</button>
        </form>
        <div id="responseMessage" class="response-message">
            <?php echo $responseMessage; // Display success or error messages ?>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
