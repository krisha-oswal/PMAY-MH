<?php
// Include the database connection file
require_once 'connection.php';

// Initialize response message and applications array
$responseMessage = '';
$applications = [];

// Approve by Tehsil function
if (isset($_POST['approveTehsil'])) {
    $applicationID = $_POST['applicationID'];
    if ($stmt = $conn->prepare("CALL ApproveByTehsil(?)")) {
        $stmt->bind_param("i", $applicationID);
        if ($stmt->execute()) {
            $responseMessage = 'Application approved by Tehsil!';
        } else {
            $responseMessage = 'Error: Could not approve the application. ' . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch all applications from the database
$sqlApplications = "SELECT * FROM Application";
$resultApplications = $conn->query($sqlApplications);

if ($resultApplications->num_rows > 0) {
    while ($application = $resultApplications->fetch_assoc()) {
        $applications[] = $application;
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
    <title>Approve Applications by Tehsil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Approve Applications by Tehsil</h1>
        <div id="responseMessage" class="response-message">
            <?php echo $responseMessage; ?>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Applicant Name</th>
                    <th>Tehsil Approval Status</th>
                    <th>Approve by Tehsil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($applications) > 0) {
                    foreach ($applications as $application) {
                        echo "<tr>
                                <td>" . $application['ApplicationID'] . "</td>
                                <td>" . $application['ApplicantName'] . "</td>
                                <td>" . ($application['ApplicationApprovedByTehsil'] ? 'Approved' : 'Pending') . "</td>
                                <td>
                                    " . (!$application['ApplicationApprovedByTehsil'] ? 
                                        "<form method='POST'>
                                            <input type='hidden' name='applicationID' value='" . $application['ApplicationID'] . "'>
                                            <button type='submit' name='approveTehsil'>Approve</button>
                                        </form>" : 
                                        "<button disabled>Approved</button>") . "
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No applications available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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
    background-color: #4CAF50;
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>
