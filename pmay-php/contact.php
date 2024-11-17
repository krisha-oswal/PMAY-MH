<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PMAY Maharashtra</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    <!-- Header Section -->
    <header class="gov-header">
        <h1>Pradhan Mantri Awas Yojana (PMAY) Maharashtra</h1>
        <p>Ministry of Housing and Urban Affairs, Government of India</p>
    </header>

    <!-- Main Content Section -->
    <main class="contact-container">
        <h2>Contact Us</h2>
        <p>If you have any questions regarding the PMAY scheme or require assistance, please use the contact information provided below. We are here to help you!</p>
        
        <!-- Contact Information Section -->
        <section class="contact-info">
            <div class="contact-details">
                <h3>Office Address</h3>
                <p>PMAY Maharashtra</p>
                <p>Ministry of Housing and Urban Affairs</p>
                <p>Rajiv Gandhi Bhawan, Lodhi Road</p>
                <p>New Delhi - 110003, India</p>
            </div>
            
            <div class="contact-details">
                <h3>Contact Numbers</h3>
                <p><strong>General Inquiry:</strong> 1800-11-1234 (Toll-Free)</p>
                <p><strong>PMAY Maharashtra Helpline:</strong> +91 1234-567890</p>
            </div>
            
            <div class="contact-details">
                <h3>Email Address</h3>
                <p><a href="mailto:pmay.support@maharashtra.gov.in">pmay.support@maharashtra.gov.in</a></p>
            </div>
        </section>
        
        <!-- Contact Form Section -->
        <section class="contact-form-section">
            <h3>Send Us a Message</h3>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $phone = htmlspecialchars($_POST['phone']);
                    $message = htmlspecialchars($_POST['message']);
                    
                    // Here you can include your backend PHP logic to process the form data,
                    // such as sending an email or saving to a database.

                    echo "<p>Thank you, $name! Your message has been submitted successfully.</p>";
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="gov-footer">
        <p>© 2024 PMAY Maharashtra. All rights reserved.</p>
        <p><a href="/privacy-policy.html">Privacy Policy</a> | <a href="/terms-of-service.html">Terms of Service</a></p>
    </footer>

</body>
</html>
