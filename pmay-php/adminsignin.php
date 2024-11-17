<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="form-container">
        <h2>Admin Portal</h2>

        <form id="signin-form" method="POST">
            <h3>Sign In</h3>
            <label for="signinuserId">User ID</label>
            <input type="number" id="signinuserId" name="signinuserId" required>

            <label for="signinpassword">Password</label>
            <input type="password" id="signinpassword" name="signinpassword" required>

            <button type="submit" name="signin">Sign In</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) {
                // Include the database connection file
                include('connection.php');

                // Retrieve and sanitize input
                $userId = intval($_POST['signinuserId']);
                $password = $_POST['signinpassword'];

                // Query to check if admin exists
                $query = "SELECT * FROM AdminPWD WHERE UserID = ? AND Password = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("is", $userId, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    echo "<p style='color: green;'>Login successful! Welcome, Admin.</p>";
                    // Redirect to the admin dashboard or any other page
                    header("Location: admindashboard.php"); // Uncomment this line to redirect
                } else {
                    echo "<p style='color: red;'>Invalid User ID or Password. Please try again.</p>";
                }

                $stmt->close();
                $conn->close();
            }
        ?>
    </div>
</body>
</html>
