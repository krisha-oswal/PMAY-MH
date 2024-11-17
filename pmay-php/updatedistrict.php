<?php
include 'connection.php'; // Ensure 'connection.php' contains your database connection details

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $districtId = $_POST['districtId'];
    $districtName = $_POST['districtName'];

    // Prepare and execute the update query
    $sql = "UPDATE District SET DistrictName = ? WHERE DistrictID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $districtName, $districtId);

    if ($stmt->execute()) {
        $message = "District updated successfully!";
    } else {
        $message = "Error updating district: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update District</title>
    <style>
        /* Basic governmental style */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        section {
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="number"], input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #003366;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #002244;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Update District</h1>
    </header>

    <section>
        <form method="POST" action="">
            <label for="districtId">District ID:</label>
            <input type="number" id="districtId" name="districtId" required>
            <label for="districtName">New District Name:</label>
            <input type="text" id="districtName" name="districtName" required>
            <button type="submit">Update District</button>
        </form>
    </section>

    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'Error') === 0 ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
</body>
</html>
