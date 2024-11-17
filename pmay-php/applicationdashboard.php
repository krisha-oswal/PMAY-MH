<?php
// Example PHP code to check if the user has applied
// This is just a simulation. Replace this with actual backend logic.
$hasApplied = true; // Set this based on your backend check
$statusMessage = "Your application is under review. Please check back later."; // Default status message

// You can fetch actual status from the database like:
$statusMessage = getApplicationStatusFromDatabase($userID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY Maharashtra - Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            margin: 0;
            background-color: #f4f6f8;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .header {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }
        .header img {
            width: 60px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 1.8em;
            color: #003366;
            margin: 5px 0;
        }
        .header p {
            font-size: 0.9em;
            color: #555;
        }
        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .button {
            background-color: #003366;
            color: #fff;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            text-align: center;
            width: 45%;
        }
        .button:hover {
            background-color: #002244;
        }
        .status {
            background-color: #e6f7ff;
            border: 1px solid #b3d9ff;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            color: #003366;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="pmay-logo-Urban.jpg" alt="PMAY">
            <h1>PMAY Maharashtra Dashboard</h1>
            <p>Welcome to the Pradhan Mantri Awas Yojana - Maharashtra Portal</p>
        </div>

        <!-- Button to Apply or Track Application -->
        <div class="button-container">
            <a href="application.php" class="button">Apply for New Application</a>
            <button id="trackStatusButton" class="button">Track Your Application</button>
        </div>

        <!-- Application Status Section (Hidden by Default) -->
        <section id="applicationStatusSection" style="display: none;">
            <h3>Application Status</h3>
            <div class="status" id="statusMessage"><?php echo $statusMessage; ?></div>
        </section>
    </div>

    <script>
        // Simulated application status check
        let hasApplied = <?php echo $hasApplied ? 'true' : 'false'; ?>;

        // Show application status if user has already applied
        document.getElementById("trackStatusButton").addEventListener("click", function() {
            if (hasApplied) {
                document.getElementById("applicationStatusSection").style.display = "block";
            } else {
                alert("No application found. Please apply first.");
            }
        });
    </script>
</body>
</html>
