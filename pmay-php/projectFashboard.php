<?php
// Optionally, check if the user is authenticated here (e.g., using a session or cookie)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY Project Dashboard</title>
    
</head>
<body>

    <div class="container">
        <header class="header">
            <h1>PMAY Maharashtra Project Dashboard</h1>
            <p>Manage your projects with ease</p>
        </header>

        <nav>
            <a href="assproject.php">Assign Project</a>
            <a href="updateproject.php">Update Project</a>
            <a href="deleteproject.php">Delete Project</a>
        </nav>

        <footer>
            <p>&copy; 2024 PMAY Maharashtra. All rights reserved.</p>
        </footer>
    </div>

    <style> 
        /* General styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f2f5;
    color: #333;
    padding: 20px;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header {
    background-color: #003366;
    color: white;
    padding: 20px;
    text-align: center;
}

.header h1 {
    font-size: 2.5em;
}

.header p {
    font-size: 1.2em;
    margin-top: 5px;
}

nav {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

nav a {
    padding: 15px 30px;
    margin: 0 20px;
    text-decoration: none;
    background-color: #003366;
    color: white;
    border-radius: 5px;
    font-size: 1.2em;
}

nav a:hover {
    background-color: #002244;
}

footer {
    background-color: #003366;
    color: white;
    text-align: center;
    padding: 10px 0;
    margin-top: 40px;
}

    </style>

</body>
</html>
