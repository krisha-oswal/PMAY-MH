<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete District</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Delete District</h1>
    </header>
    <section>
        <form id="deleteDistrictForm" method="POST">
            <label for="districtId">District ID:</label>
            <input type="text" id="districtId" name="districtId" required>
            <button type="submit">Delete District</button>
        </form>
        <div id="responseMessage"><?php handleDeleteRequest(); ?></div>
    </section>

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

        h1 {
            margin: 0;
        }

        section {
            padding: 20px;
        }

        input[type="text"], button {
            padding: 10px;
        }

        button {
            background-color: #003366; /* Dark blue button */
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #002244; /* Darker blue on hover */
        }

        #responseMessage {
            margin-top: 20px;
        }
    </style>

<?php
function handleDeleteRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['districtId'])) {
        include 'connection.php'; // Your database connection file

        $districtId = htmlspecialchars($_POST['districtId']);

        if (empty($districtId)) {
            echo "<p style='color: red;'>District ID is required.</p>";
            return;
        }

        try {
            // Prepare and execute the DELETE query
            $query = "DELETE FROM District WHERE DistrictID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $districtId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<p style='color: green;'>District deleted successfully.</p>";
            } else {
                echo "<p style='color: red;'>District not found.</p>";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "<p style='color: red;'>Error deleting district: " . $e->getMessage() . "</p>";
        }

        $conn->close();
    }
}
?>

</body>
</html>
