<?php
// Include the database connection file
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Log - PMAY Maharashtra</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #003366;
            font-size: 20px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #003366;
            color: white;
            text-transform: uppercase;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #f1f4f7;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #003366;
            color: white;
            font-size: 14px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>PMAY Maharashtra - Project Log</h1>
    </header>

    <div class="container">
        <h2>Project Activity Log</h2>
        <table>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Action Performed</th>
                    <th>Old Project Name</th>
                    <th>New Project Name</th>
                    <th>Old Total Units</th>
                    <th>New Total Units</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SQL query to fetch log data
                $query = "SELECT ProjectID, ActionPerformed, OldProjectName, NewProjectName, OldTotalUnits, NewTotalUnits, Timestamp FROM ProjectLog ORDER BY Timestamp DESC";
                $result = $conn->query($query);

                // Check if rows exist
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ProjectID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ActionPerformed']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['OldProjectName'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['NewProjectName'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['OldTotalUnits'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['NewTotalUnits'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Timestamp']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>No logs found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        &copy; 2024 PMAY Maharashtra - All Rights Reserved
    </footer>
</body>
</html>
