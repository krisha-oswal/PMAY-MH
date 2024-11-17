<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY Maharashtra - Document Submission</title>
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
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #003366;
        }
        input[type="file"] {
            display: block;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        button {
            background-color: #003366;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
        }
        button:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="pmay-logo-Urban.jpg" alt="PMAY">
            <h1>Document Submission - PMAY Maharashtra</h1>
            <p>Please upload the necessary documents for your application.</p>
        </div>

        <form id="documentForm" action="http://localhost:3000/document-submission" method="POST" enctype="multipart/form-data">
            <h3>Identity Proof</h3>
            <label for="identityProofVoterID">Voter ID</label>
            <input type="file" id="identityProofVoterID" name="identityProofVoterID" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="passport">Passport</label>
            <input type="file" id="passport" name="identityProofPassport" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="identityProofDrivingLicense">Driving License</label>
            <input type="file" id="identityProofDrivingLicense" name="identityProofDrivingLicense" accept=".pdf, .jpg, .jpeg, .png">
        
            <h3>Address Proof</h3>
            <label for="addressProofUtilityBill">Utility Bill</label>
            <input type="file" id="addressProofUtilityBill" name="addressProofUtilityBill" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="addressProofRentAgreement">Rent Agreement</label>
            <input type="file" id="addressProofRentAgreement" name="addressProofRentAgreement" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="addressProofRelevantDocumentIssued">Relevant Document Issued</label>
            <input type="file" id="addressProofRelevantDocumentIssued name="addressProofRelevantDocumentIssued" accept=".pdf, .jpg, .jpeg, .png">
        
            <h3>Income Proof</h3>
            <label for="incomeProofSalarySlips">Salary Slips</label>
            <input type="file" id="incomeProofSalarySlips" name="incomeProofSalarySlips" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="incomeProofIncomeTaxReturns">Income Tax Returns</label>
            <input type="file" id="incomeProofIncomeTaxReturns" name="incomeProofIncomeTaxReturns" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="incomeProofBankStatements">Bank Statements</label>
            <input type="file" id="incomeProofBankStatements" name="incomeProofBankStatements" accept=".pdf, .jpg, .jpeg, .png">
        
            <h3>Property Documents</h3>
            <label for="propertyDocumentsSaleDeed">Sale Deed</label>
            <input type="file" id="propertyDocumentsSaleDeed name="propertyDocumentsSaleDeed" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="propertyDocumentsPropertyRegistration">Property Registration</label>
            <input type="file" id="propertyDocumentsPropertyRegistration" name="propertyDocumentsPropertyRegistration" accept=".pdf, .jpg, .jpeg, .png">
        
            <label for="propertyDocumentsOtherProofOfPurchase">Other Proof of Purchase</label>
            <input type="file" id="propertyDocumentsOtherProofOfPurchase" name="propertyDocumentsOtherProofOfPurchase" accept=".pdf, .jpg, .jpeg, .png">
        
            <div class="button-container">
                <button type="submit">Submit Documents</button>
            </div>
        </form>
    </div>
    <?php
// Include your database connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace with the actual Applicant ID; you might get this from session or form data
    $applicantID = $_POST['applicantID'];

    // Prepare the SQL statements for each document table
    $queries = [
        'identityProof' => "INSERT INTO IdentityProof (ApplicantID, VoterID, Passport, DrivingLicense, Valid) VALUES (?, ?, ?, ?, 'valid')",
        'addressProof' => "INSERT INTO AddressProof (ApplicantID, UtilityBill, RentAgreement, RelevantDocumentIssued, Valid) VALUES (?, ?, ?, ?, 'valid')",
        'incomeProof' => "INSERT INTO IncomeProof (ApplicantID, SalarySlips, IncomeTaxReturns, BankStatements, Valid) VALUES (?, ?, ?, ?, 'valid')",
        'propertyDocuments' => "INSERT INTO PropertyDocuments (ApplicantID, SaleDeed, PropertyRegistration, OtherProofOfPurchase, Valid) VALUES (?, ?, ?, ?, 'valid')",
    ];

    // Prepare the file paths
    $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
    $filePaths = [
        'VoterID' => null,
        'Passport' => null,
        'DrivingLicense' => null,
        'UtilityBill' => null,
        'RentAgreement' => null,
        'RelevantDocumentIssued' => null,
        'SalarySlips' => null,
        'IncomeTaxReturns' => null,
        'BankStatements' => null,
        'SaleDeed' => null,
        'PropertyRegistration' => null,
        'OtherProofOfPurchase' => null,
    ];

    // Loop over each file field, save to server, and set the file path
    foreach ($filePaths as $field => &$path) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES[$field]['name']);
            $path = $uploadDir . $filename;

            // Move the uploaded file to the server directory
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $path)) {
               // $path = $path; // Keep the path if successful
            } else {
                $path = null; // Set to null if upload fails
            }
        }
    }

    // Prepare and execute each SQL statement with the relevant file paths
    foreach ($queries as $type => $sql) {
        $stmt = $conn->prepare($sql);

        switch ($type) {
            case 'identityProof':
                $stmt->bind_param("isss", $applicantID, $filePaths['VoterID'], $filePaths['Passport'], $filePaths['DrivingLicense']);
                break;
            case 'addressProof':
                $stmt->bind_param("isss", $applicantID, $filePaths['UtilityBill'], $filePaths['RentAgreement'], $filePaths['RelevantDocumentIssued']);
                break;
            case 'incomeProof':
                $stmt->bind_param("isss", $applicantID, $filePaths['SalarySlips'], $filePaths['IncomeTaxReturns'], $filePaths['BankStatements']);
                break;
            case 'propertyDocuments':
                $stmt->bind_param("isss", $applicantID, $filePaths['SaleDeed'], $filePaths['PropertyRegistration'], $filePaths['OtherProofOfPurchase']);
                break;
        }

        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        } else {
            echo ucfirst($type) . " documents submitted successfully.";
        }
        $stmt->close();
    }

    $conn->close();
}
?>


    <script>
        document.getElementById('documentForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);
    
    // Check if at least one file is included for identity proof
    const identityProofFiles = [
        'identityProofVoterID',
        'identityProofPassport',
        'identityProofDrivingLicense'
    ];
    const isIdentityProofValid = identityProofFiles.some(file => formData.has(file));

    if (!isIdentityProofValid) {
        alert("Please upload at least one identity proof document.");
        return;
    }

    // Additional checks for other required documents can be added here
    // Example: Check if at least one address proof is uploaded
    const addressProofFiles = [
        'addressProofUtilityBill',
        'addressProofRentAgreement',
        'addressProofRelevantDocumentIssued'
    ];
    const isAddressProofValid = addressProofFiles.some(file => formData.has(file));

    if (!isAddressProofValid) {
        alert("Please upload at least one address proof document.");
        return;
    }
    const incomeprooffiles =[
        'incomeProofSalarySlips',
        'incomeProofIncomeTaxReturns',
        'incomeProofBankStatements'
    ];
    const isIncomeProofValid = incomeprooffiles.some(file => formData.has(file));

if (!isIncomeProofValid) {
    alert("Please upload at least one income proof document.");
    return;
}
const propertyprooffiles =[
        'propertyDocumentsSaleDeed',
        'propertyDocumentsPropertyRegistration',
        'propertyDocumentsOtherProofOfPurchase'
    ];
    const isPropertyProofValid = propertyprooffiles.some(file => formData.has(file));

if (!isPropertyProofValid) {
    alert("Please upload at least one property proof document.");
    return;
}

    // Continue with submission if all checks pass
    try {
        const response = await fetch('http://localhost:3000/document-submission', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Failed to submit documents. Please try again.');
        }

        const data = await response.json();
        
        if (data.success) {
            alert('Documents submitted successfully!');
            window.location.href = 'http://localhost:3000/applicantdashboard.html';
        } else {
            alert(data.message || 'Document submission failed.');
        }
    } catch (error) {
        console.error('Error during submission:', error);
        alert(error.message || 'An error occurred while submitting the form.');
    }
});
    </script>
</body>
</html>    