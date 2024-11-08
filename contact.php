<?php include('partials-front/menu.php'); ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - DessertHub</title>
    <style>
       /* Header Styling */
.header {
    text-align: center;
    background-color: #2ec4b6; /* Darker shade */
    color: white;
    padding: 40px 20px;
    border-bottom: 3px solid #333333;
}

.header h1 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.header p {
    font-size: 1.1em;
}

/* Contact Form Styling */

.contact-form {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers the form elements horizontally */
    justify-content: center; /* Centers the form elements vertically (if desired) */
    margin: 0 auto; /* Centers the form container itself */
}

.contact-form label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #333333;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    max-width: 600px; /* Adjusts the width to a maximum of 600px */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}


.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #45A982; /* Matches header color */
    outline: none;
}

/* Submit Button */
.submit-button {
    background-color: #2ec4b6; /* Darker shade */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #38a3a5; /* Slightly darker on hover */
}

    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Please reach out with any questions or feedback.</p>
    </header>

    <br>
    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="contact-container">
            <form action="#" method="POST" class="contact-form">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit" class="submit-button">Send Message</button>
            </form>
        </div>
    </section>

</body>
</html>
    <p style="margin-bottom: 250px">
        <br>
    </p>
<?php include('partials-front/footer.php'); ?>  