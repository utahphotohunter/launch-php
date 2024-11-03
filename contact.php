<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";


// takes input responses and looks for html tags and puts responses into variables
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $contactFirstName = isset($_POST["contactFirstName"]) ? htmlspecialchars($_POST["contactFirstName"]) : "";
    $contactLastName = isset($_POST["contactLastName"]) ? htmlspecialchars($_POST["contactLastName"]) : "";
    $contactEmail = isset($_POST["contactEmail"]) ? htmlspecialchars($_POST["contactEmail"]) : "";
    $contactMessage = isset($_POST["contactMessage"]) ? htmlspecialchars($_POST["contactMessage"]) : "";

    // email addresses
    // $email_no_reply = "xxxxx@xxxxxxxxx@gmail.com";
    // $email_russ = "xxxxx@xxxxxxxxx@gmail.com";
    // $email_brady = "xxxxx@xxxxxxxxx@gmail.com";

    // subject and message variables
    $submitted_subject = "Website Contact Request";
    $sender_email = $contactEmail;
    $sender_message = wordwrap($contactMessage);
    $embedded_image =  '<img alt="launch_logo" src="cid:launch_logo">';
    $email_body = nl2br($contactFirstName . " " . $contactLastName . "\n" . $sender_email . "\n\n" . $sender_message . "\n" . $embedded_image);

    // email containing submission

    // access to gmail account to be used for sending emails to company
    $mailer = new PHPMailer(true);
    $mailer->isSMTP();
    $mailer->Host = "smtp.gmail.com";
    $mailer->SMTPAuth = true;
    // $mailer->Username = "xxxxx@xxxxxxxxx@gmail.com";
    // $mailer->Password = "xxxx xxxx xxxx xxxx";
    $mailer->SMTPSecure = "ssl";
    $mailer->Port = "465";
    // $mailer->setFrom("xxxxx@xxxxxxxxx@gmail.com");

    // email content
    $mailer->addAddress($email_no_reply);
    $mailer->isHTML(true);
    // $mailer->addCC($email_russ);
    // $mailer->addBCC($email_brady);
    $mailer->Subject = $submitted_subject;
    $mailer->addEmbeddedImage("img/launch_logo_email.jpg", "launch_logo", "launch_logo");
    $mailer->Body = $email_body;

    $mailer->send();


    // confirmation email

    // access to gmail account to be used for sending response emails to sender
    $mailer_response = new PHPMailer(true);
    $mailer_response->isSMTP();
    $mailer_response->Host = "smtp.gmail.com";
    $mailer_response->SMTPAuth = true;
    // $mailer_response->Username = "xxxxx@xxxxxxxxx@gmail.com";
    // $mailer_response->Password = "xxxx xxxx xxxx xxxx";
    $mailer_response->SMTPSecure = "ssl";
    $mailer_response->Port = "465";
    // $mailer_response->setFrom("xxxxx@xxxxxxxxx@gmail.com");

    // email content variables
    $response_subject = "no-reply Launch Services";
    $response_message = nl2br("Thank you " . $contactFirstName . ", for contacting Launch Services. Our team is reviewing your message and will reach out to you at this email address. \n\n This message was sent from an account that is not monitored. \n\n" . $embedded_image);

    //email content
    // $mailer_response->addAddress($sender_email);
    $mailer_response->addAddress($email_no_reply);
    $mailer_response->isHTML(true);
    $mailer_response->Subject = $response_subject;
    $mailer_response->addEmbeddedImage("img/launch_logo_email.jpg", "launch_logo", "launch_logo");
    $mailer_response->Body = $response_message;

    $mailer_response->send();

    echo "<script>alert('Your message was sent successfully.')</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact us with any questions you have.">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/styles-mobile.css">
    <script src="https://kit.fontawesome.com/e8bf802880.js" crossorigin="anonymous"></script>
    <script src="./script/script.js" defer></script>
    <title>Launch Services | Contact Us</title>
</head>

<body id="contact-body">
    <header>
        <nav id="navbar">
            <!-- main menu -->
            <div class="container main-menu">
                <a href="index.html" class="logo-link"><img src="img/webp/launch_logo_crop.webp" alt="Launch Services LLC logo" class="logo" loading="lazy"></a>
                <ul class="main-menu-list">
                    <li class="btn"><a href="index.html">Home</a></li>
                    <li class="btn"><a href="services.html">Services</a></li>
                    <li class="btn"><a href="about.html">About</a></li>
                    <li class="btn"><a href="staff.html">Staff</a></li>
                    <li class="btn"><a href="https://thelaunchpads.blogspot.com/" target="_blank">Blog</a></li>
                    <li class="btn"><a class="current" href="#">Contact</a></li>
                </ul>
            </div>
            <!-- mobile menu -->
            <div class="container mobile-menu">
                <a href="index.html" class="logo-link"><img src="img/webp/launch_logo_crop.webp" alt="Launch Services LLC logo" class="logo" loading="lazy"></a>
                <div class="mobile-menu-toggle">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </div>
                <div class="mobile-menu-list-items">
                    <ul class="mobile-menu-list">
                        <li class="btn"><a href="index.html">Home</a></li>
                        <li class="btn"><a href="services.html">Services</a></li>
                        <li class="btn"><a href="about.html">About</a></li>
                        <li class="btn"><a href="staff.html">Staff</a></li>
                        <li class="btn"><a href="https://thelaunchpads.blogspot.com/" target="_blank">Blog</a></li>
                        <li class="btn"><a class="current" href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="contact-showcase" class="showcase">
            <div id="contact-showcase-content" class="showcase-content">
                <h1 class="primary-text"><span class="accent-text">Contact</span> Us</h1>
            </div>
        </section>
        <section id="contact-form">
            <div class="container" id="contact-form-preface">
                <h2>Fill out the form below and reach out to us!</h2>
            </div>
            <div class="contact-form">
                <form method="post">
                    <div class="container contact-form-divs" id="contact-name-inputs">
                        <label for="contactFirstName">First Name: </label>
                        <input type="text" id="contactFirstName" name="contactFirstName" placeholder="John" required><br>
                        <label for="contactLastName">Last Name: </label>
                        <input type="text" id="contactLastName" name="contactLastName" placeholder="Doe" required>
                    </div>
                    <div class="container contact-form-divs" id="contact-email-inputs">
                        <label for="contactEmail">Email: </label>
                        <input type="email" id="contactEmail" name="contactEmail" placeholder="john.doe@email.com" required>
                    </div>
                    <div class="container contact-form-divs" id="contact-message-inputs">
                        <label for="contactMessage">Message</label><br>
                        <textarea type="message" name="contactMessage" id="contactMessage"
                            placeholder="Enter your message here" required></textarea>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn dark-btn" name="submit" id="contact_submit">Submit</button>
                        <button type="reset" class="btn dark-btn" name="reset" id="contact_reset">Reset</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer id="footer">
        <p>Copyright &copy;<span id="year"></span> - Launch Services, LLC</p>
        <a href="careers.html">Careers</a>
    </footer>
</body>

</html>