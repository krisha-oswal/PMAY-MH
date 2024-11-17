<?php
// Example of including a file for database connection or session handling
// include('connection.php'); // Uncomment and adjust if you have a connection file
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY Maharashtra Sanctioner Dashboard</title>
    <style>
        /* Basic resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #2a3f54;
            color: white;
            padding: 20px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            height: 60px;
            z-index: 1000;
        }

        .logo {
            height: 40px;
        }

        .sidebar {
            width: 200px;
            background-color: #33475b;
            color: white;
            padding: 20px;
            position: fixed;
            top: 60px;
            bottom: 0;
        }

        .sidebar nav ul {
            list-style-type: none;
        }

        .sidebar nav ul li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #444;
        }

        .sidebar nav ul li:hover {
            background-color: #3f566e;
        }

        .main-content {
            margin-left: 220px;
            padding: 80px 20px 20px;
            width: 100%;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .summary-cards {
            display: flex;
            gap: 15px;
        }

        .card {
            flex: 1;
            padding: 20px;
            background-color: #f3f3f3;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 1.2em;
        }

        .application-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .application-table th,
        .application-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .logout-btn {
            background-color: #d9534f;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <img src="pmay-logo-Urban.jpg" alt="PMAY Logo" class="logo">
        <h1>Pradhan Mantri Awas Yojana - Maharashtra</h1>
        <p>Housing for All</p>
        <button class="logout-btn" onclick="logout()">Logout</button>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav>
            <ul>
                <li onclick="showSection('overview')">Dashboard Overview</li>
                <li onclick="showSection('pending')">Pending Applications</li>
                <li onclick="showSection('approved')">Approved Applications</li>
                <li onclick="showSection('rejected')">Rejected Applications</li>
                <li onclick="showSection('reports')">Reports</li>
                <li><a href="assproject.php">Assign Project</a></li>
                <li><a href="updateproject.php">Update Project</a></li>
                <li><a href="deleteproject.php">Delete Project</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Dashboard -->
    <main class="main-content">
        <section id="overview" class="content-section active">
            <h2>Welcome, Sanctioner</h2>
            <div class="summary-cards">
                <div class="card">Total Applications: <span id="totalApps"><?= $totalApps ?></span></div>
                <div class="card">Pending Approvals: <span id="pendingApps"><?= $pendingApps ?></span></div>
                <div class="card">Approved: <span id="approvedApps"><?= $approvedApps ?></span></div>
                <div class="card">Rejected: <span id="rejectedApps"><?= $rejectedApps ?></span></div>
            </div>
        </section>

        <section id="pending" class="content-section hidden">
            <h2>Pending Applications</h2>
            <table class="application-table">
                <thead>
                    <tr>
                        <th>Applicant ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="pendingApplications">
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>Mumbai</td>
                        <td>Pending</td>
                        <td>
                            <button onclick="approveApplication('001')">Approve</button>
                            <button onclick="rejectApplication('001')">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        // Function to toggle between different sections in the sidebar
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }

        // Placeholder function for logging out
        function logout() {
            alert("You have logged out.");
            // Redirect or perform any necessary actions for logout
        }

        // Placeholder functions for approving/rejecting applications
        function approveApplication(applicantId) {
            alert(`Application ${applicantId} approved.`);
            // Add code to handle backend update for approving the application
        }

        function rejectApplication(applicantId) {
            alert(`Application ${applicantId} rejected.`);
            // Add code to handle backend update for rejecting the application
        }

        // Set the initial section to display
        document.addEventListener('DOMContentLoaded', () => {
            showSection('overview');
        });
    </script>
</body>

</html>
