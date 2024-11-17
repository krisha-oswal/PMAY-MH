<?php
// Include your database connection file
require_once 'connection.php';

// Initialize a variable for response message
$responseMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $districtId = $_POST['districtId'];
    $projectId = $_POST['projectId'];

    // Validate the input
    if (empty($districtId) || empty($projectId)) {
        $responseMessage = 'District ID and Project ID are required.';
    } else {
        // Prepare SQL query to insert the data into the database
        $sql = "INSERT INTO DistrictProject (DistrictID, ProjectID) VALUES (?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ii", $districtId, $projectId);
            
            // Execute the query
            if ($stmt->execute()) {
                $responseMessage = 'District Project added successfully!';
            } else {
                $responseMessage = 'Error: Could not execute the query. ' . $stmt->error;
            }
            
            // Close statement
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
    <title>District Project Management</title>
</head>
<body>
    <header>
        <h1>PMAY Maharashtra - District Project Management</h1>
        <p>Manage District Projects for PMAY Maharashtra</p>
    </header>

    <main>
        <section>
            <h2>Add District Project</h2>
            <form id="districtProjectForm" method="POST">
                <label for="districtId">District ID:</label>
                <input type="number" id="districtId" name="districtId" required>

                <label for="projectId">Project ID:</label>
                <input type="number" id="projectId" name="projectId" required>

                <button type="submit">Add District Project</button>
            </form>
            <div id="responseMessage">
                <?php echo $responseMessage; // Display success or error messages ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 PMAY Maharashtra. All rights reserved.</p>
    </footer>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #003366; /* Dark blue header */
            color: white;
            padding: 20px;
        }

        h1, h2 {
            margin: 0;
        }

        main {
            padding: 20px;
        }

        input[type="number"], button {
            padding: 10px;
        }

        button {
            background-color: #003366; /* Dark blue button */
            color: white;
        }

        button:hover {
            background-color: #002244; /* Darker blue on hover */
        }

        #responseMessage {
            margin-top: 20px;
        }
    </style>
</body>
</html>
