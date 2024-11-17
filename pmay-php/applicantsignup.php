<?php
include 'connection.php'; // Include database connection file

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === "signin") {
        // Sign-in Logic
        $phoneNumber = $_POST['signin-PhoneNumber'];
        $password = $_POST['signin-Password'];

        $sql = "SELECT * FROM ApplicantPWD WHERE PhoneNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) { // Secure password verification
                session_start();
                $_SESSION['applicantID'] = $user['ApplicantID']; // Use session for authentication
                header("Location: applicantdashboard.php");
                exit(); // Ensure no further code is executed
            } else {
                $message = "Invalid phone number or password.";
            }
        } else {
            $message = "Invalid phone number or password.";
        }
        $stmt->close();
    } elseif (isset($_POST['action']) && $_POST['action'] === "signup") {
        // Sign-up Logic
        $phoneNumber = $_POST['signup-PhoneNumber'];
        $password = $_POST['signup-Password'];

        // Check if the phone number already exists
        $sql = "SELECT * FROM ApplicantPWD WHERE PhoneNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Phone number already registered.";
        } else {
            // Insert the new user
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Secure password hashing
            $sql = "INSERT INTO ApplicantPWD (PhoneNumber, Password, UserID) VALUES (?, ?, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $phoneNumber, $hashedPassword);

            if ($stmt->execute()) {
                $message = "Sign-up successful! You can now sign in.";
            } else {
                $message = "Error: Could not complete sign-up.";
            }
        }
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Portal - Sign In / Sign Up</title>
    <style>
         
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f1f1f1;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="number"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #004085;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #002752;
        }
        .toggle {
            margin-top: 10px;
            font-size: 0.9em;
            color: #004085;
            cursor: pointer;
            text-decoration: underline;
        }
        .toggle:hover {
            color: #002752;
        }
    
    </style>
</head>
<body>
    <div class="container">
        <h2>Applicant Portal</h2>
        <p><?php echo $message; ?></p>
        <div id="form">
            <!-- Sign-In Form -->
            <form action="" method="POST">
                <h3>Sign In</h3>
                <label for="signin-PhoneNumber">Phone Number</label>
                <input type="number" name="signin-PhoneNumber" required>

                <label for="signin-Password">Password</label>
                <input type="password" name="signin-Password" required>

                <button type="submit" name="action" value="signin">Sign In</button>

                <p>Don't have an account? <a href="#" onclick="showSignUp()">Sign Up</a></p>
            </form>

            <!-- Sign-Up Form -->
            <form action="" method="POST" style="display: none;">
                <h3>Sign Up</h3>
                <label for="signup-PhoneNumber">Phone Number</label>
                <input type="number" name="signup-PhoneNumber" required>

                <label for="signup-Password">Password</label>
                <input type="password" name="signup-Password" required>

                <button type="submit" name="action" value="signup">Sign Up</button>

                <p>Already have an account? <a href="#" onclick="showSignIn()">Sign In</a></p>
            </form>
        </div>
    </div>

    <script>
        function showSignUp() {
            document.forms[0].style.display = 'none';
            document.forms[1].style.display = 'block';
        }

        function showSignIn() {
            document.forms[1].style.display = 'none';
            document.forms[0].style.display = 'block';
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
