<?php
// Include the database connection file
require_once 'connection.php';

// Initialize the response message variable
$responseMessage = '';

// Variable to store logs
$projectLogs = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $projectName = $_POST['projectName'];
    $totalUnits = $_POST['totalUnits'];

    // Check if the fields are not empty
    if (empty($projectName) || empty($totalUnits)) {
        $responseMessage = 'Project Name and Total Units are required.';
    } else {
        // Prepare SQL query to insert the project data
        $sql = "INSERT INTO Projects (ProjectName, TotalUnits) VALUES (?, ?)";

        // Prepare and execute the query
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("si", $projectName, $totalUnits);

            // Execute the query
            if ($stmt->execute()) {
                $responseMessage = 'Project added successfully!';
            } else {
                $responseMessage = 'Error: Could not execute the query. ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $responseMessage = 'Error: Could not prepare the query. ' . $conn->error;
        }
    }
}

// Fetch all project logs
$sqlLogs = "SELECT * FROM ProjectLog ORDER BY ActionDate DESC"; // Order by ActionDate or any other relevant field
$resultLogs = $conn->query($sqlLogs);

// Fetch the logs into an array
if ($resultLogs->num_rows > 0) {
    while ($log = $resultLogs->fetch_assoc()) {
        $projectLogs[] = $log;
    }
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Project</h1>
        <form id="addProjectForm" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="projectName">Project Name:</label>
                <input type="text" id="projectName" name="projectName" required>
            </div>
            <div class="form-group">
                <label for="totalUnits">Total Units:</label>
                <input type="number" id="totalUnits" name="totalUnits" required>
            </div>
            <button type="submit">Add Project</button>
        </form>

        <div id="responseMessage" class="response-message">
            <?php echo $responseMessage; // Display success or error messages ?>
        </div>

        <!-- Display Project Logs -->
        <h2>Project Logs</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Action Performed</th>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Action Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($projectLogs) > 0) {
                    foreach ($projectLogs as $log) {
                        echo "<tr>
                                <td>" . $log['LogID'] . "</td>
                                <td>" . $log['ActionPerformed'] . "</td>
                                <td>" . $log['ProjectID'] . "</td>
                                <td>" . $log['NewProjectName'] . "</td>
                                <td>" . $log['ActionDate'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No logs available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function validateForm() {
            // Get form values
            const projectName = document.getElementById('projectName').value;
            const totalUnits = document.getElementById('totalUnits').value;

            // Validate Project Name
            if (projectName === "") {
                alert("Project Name is required.");
                return false;
            }

            // Validate Total Units (must be a positive number)
            if (totalUnits === "" || totalUnits <= 0) {
                alert("Total Units must be a positive number.");
                return false;
            }

            return true; // Allow form submission if validation passes
        }
    </script>
</body>
</html>
