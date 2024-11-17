<?php
// Include the database connection file
require_once 'connection.php';

// Initialize variables
$responseMessage = '';
$projects = [];

// Handle deletion of project
if (isset($_POST['deleteProject'])) {
    $projectID = $_POST['projectID'];

    // Prepare the DELETE SQL query
    $sqlDelete = "DELETE FROM Project WHERE ProjectID = ?";

    if ($stmt = $conn->prepare($sqlDelete)) {
        $stmt->bind_param("i", $projectID);

        if ($stmt->execute()) {
            $responseMessage = 'Project deleted successfully!';
        } else {
            $responseMessage = 'Error: Could not delete the project. ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $responseMessage = 'Error: Could not prepare the delete query. ' . $conn->error;
    }
}

// Fetch all projects from the database to display in the table
$sqlProjects = "SELECT * FROM Project";
$resultProjects = $conn->query($sqlProjects);

if ($resultProjects->num_rows > 0) {
    while ($project = $resultProjects->fetch_assoc()) {
        $projects[] = $project;
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
    <title>Delete Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Delete Project</h1>
        <div id="responseMessage" class="response-message">
            <?php echo $responseMessage; ?>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Total Units</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($projects) > 0) {
                    foreach ($projects as $project) {
                        echo "<tr>
                                <td>" . $project['ProjectID'] . "</td>
                                <td>" . $project['ProjectName'] . "</td>
                                <td>" . $project['TotalUnits'] . "</td>
                                <td>
                                    <form method='POST'>
                                        <input type='hidden' name='projectID' value='" . $project['ProjectID'] . "'>
                                        <button type='submit' name='deleteProject'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No projects available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    body {
    font-family: Arial, sans-serif;
}

.container {
    width: 80%;
    margin: 0 auto;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

button {
    padding: 5px 10px;
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.response-message {
    color: green;
    text-align: center;
    margin-top: 20px;
}

</style>
</body>
</html>
