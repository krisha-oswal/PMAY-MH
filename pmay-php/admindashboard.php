<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PMAY Maharashtra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #003366;
            text-align: center;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #00509e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Admin Dashboard - PMAY Maharashtra</h1>

    <div class="card">
        <h2>District Office</h2>
        <button onclick="navigateTo('districtDashboard.php')">District Office Dashboard</button>
    </div>

    <div class="card">
        <h2>Project</h2>
        <button onclick="navigateTo('projectDashboard.php')">Project Dashboard</button>
    </div>

    <div class="card">
        <h2>Project Manager</h2>
        <button onclick="navigateTo('projectManagerDashboard.php')">Project Manager Dashboard</button>
    </div>

    <div class="card">
        <h2>Link District and Project</h2>
        <button onclick="navigateTo('linkDistrictProject.php')">Link District and Project</button>
    </div>

    <div class="card">
        <h2>Sanctioner</h2>
        <button onclick="navigateTo('sanctionerDashboard.php')">Sanctioner Dashboard</button>
    </div>

    <script>
        function navigateTo(page) {
            // Redirect to the specified page
            window.location.href = page;
        }
    </script>
</body>
</html>
