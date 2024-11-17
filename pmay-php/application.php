<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY Maharashtra Application Form</title>
    <style>
           * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 700px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        h2 {
            font-size: 1.5em;
        }
        label {
            font-weight: bold;
            color: #555;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>PMAY Maharashtra Application Form</h2>
            <p>Fill out the application form with accurate information.</p>
        </div>
        
        <?php
        // Include the connection file to connect to the database
        include('connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect form data
            $name = $_POST['Name'];
            $email = $_POST['EmailID'];
            $phone = $_POST['PhoneNumber'];
            $gender = $_POST['Gender'];
            $streetNumber = $_POST['streetNumber'];
            $streetName = $_POST['StreetName'];
            $landmark = $_POST['Landmark'];
            $city = $_POST['City'];
            $district = $_POST['District'];
            $pincode = $_POST['PinCode'];
            $income = $_POST['Income'];
            $incomeCategory = $_POST['incomeCategory'];
            $type = $_POST['Type'];

            // Prepare SQL queries
            $applicantID = 27000000; // Starting ID, change as required
            $success = true;

            // Insert into Application table
            $sqlApp = "INSERT INTO Application ( Type) VALUES ( '$type')";
            if (!mysqli_query($conn, $sqlApp)) {
                $success = false;
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            // Insert into Financial table
            $sqlFin = "INSERT INTO Financial ( Income, IncomeCategory) VALUES ( '$income', '$incomeCategory')";
            if (!mysqli_query($conn, $sqlFin)) {
                $success = false;
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            // Insert into Address table
            $sqlAddr = "INSERT INTO Address ( PinCode, StreetNumber, StreetName, LandMark, City, District) VALUES ('$pincode', '$streetNumber', '$streetName', '$landmark', '$city', '$district')";
            if (!mysqli_query($conn, $sqlAddr)) {
                $success = false;
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            if ($success) {
                echo "<p>Application submitted successfully!</p>";
            } else {
                echo "<p>Failed to submit application. Please try again.</p>";
            }
        }
        ?>

        <form id="applicationForm" action="" method="POST">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" id="Name" name="Name" required>
            </div>
            <div class="form-group">
                <label for="EmailID">EmailID</label>
                <input type="email" id="EmailID" name="EmailID" required>
            </div>
            <div class="form-group">
                <label for="PhoneNumber">PhoneNumber</label>
                <input type="tel" id="PhoneNumber" name="PhoneNumber" required>
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label>
                <select id="Gender" name="Gender" required>
                    <option value="">Select</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <label for="streetNumber">Street Number</label>
                <input type="text" id="streetNumber" name="streetNumber" required>
            </div>
            <div class="form-group">
                <label for="StreetName">Street Name</label>
                <input type="text" id="StreetName" name="StreetName" required>
            </div>
            <div class="form-group">
                <label for="Landmark">Landmark</label>
                <input type="text" id="Landmark" name="Landmark">
            </div>
            <div class="form-group">
                <label for="City">City</label>
                <input type="text" id="City" name="City" required>
            </div>
            <div class="form-group">
                <label for="District">District</label>
                <input type="text" id="District" name="District" required>
            </div>
            <div class="form-group">
                <label for="PinCode">Pincode</label>
                <input type="number" id="PinCode" name="PinCode" required>
            </div>
            <div class="form-group">
                <label for="Income">Income</label>
                <input type="number" id="Income" name="Income" required>
            </div>
            <div class="form-group">
                <label for="incomeCategory">Income Category</label>
                <select id="incomeCategory" name="incomeCategory" required>
                    <option value="">Select</option>
                    <option value="EWS">EWS</option>
                    <option value="LIG">LIG</option>
                    <option value="MIG I">MIG I</option>
                    <option value="MIG II">MIG II</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Type">Type</label>
                <select id="Type" name="Type" required>
                    <option value="">SELECT</option>
                    <option value="urban">PMAY-U</option>
                    <option value="rural">PMAY-G</option>
                </select>
            </div>
            <div class="button-container">
                <button type="submit">Submit Application</button>
            </div>
        </form>
        <div class="link-container">
            <p>After submitting, please <a href="document-submission.html">click here</a> to upload your documents.</p>
        </div>
    </div>
</body>
</html>
