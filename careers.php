<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";


// takes input responses and looks for html tags and puts responses into variables
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $careersFirstName = isset($_POST["careersFirstName"]) ? htmlspecialchars($_POST["careersFirstName"]) : "";
    $careersLastName = isset($_POST["careersLastName"]) ? htmlspecialchars($_POST["careersLastName"]) : "";
    $careersEmail = isset($_POST["careersEmail"]) ? htmlspecialchars($_POST["careersEmail"]) : "";
    $careersPhone = isset($_POST["careersPhone"]) ? htmlspecialchars($_POST["careersPhone"]) : "";
    $careersFileName = $_FILES["careersFile"]["name"];
    $careersFile = $_FILES["careersFile"]["tmp_name"];
    $careersFileType = $_FILES["careersFile"]["type"];


    if ($careersFileType === "application/pdf") {

        // email addresses
        // $email_no_reply = "xxxxx@xxxxxxxxx@gmail.com";
        // $email_russ = "rxxxxx@xxxxxxxxx@gmail.com";
        // $email_brady = "xxxxx@xxxxxxxxx@gmail.com";

        // subject and message variables
        $submitted_subject = "Website Resume Submission";
        $sender_email = $careersEmail;
        $embedded_image =  '<img alt="launch_logo" src="cid:launch_logo">';
        $email_body = nl2br($careersFirstName . " " . $careersLastName . "\n" . $sender_email . "\n" . $careersPhone . "\n\n" . $embedded_image);

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
        $mailer->addAttachment($careersFile, $careersFileName);
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
        $mailer_response->setFrom("xxxxx@xxxxxxxxx@gmail.com");

        // email content variables
        $response_subject = "no-reply Launch Services";
        $response_message = nl2br("Thank you " . $careersFirstName . ", for contacting Launch Services. Our team is reviewing your resume and will reach out to you at this email address if we have any openings we feel you would be a good fit for. Thank you for your interest. \n\n This message was sent from an account that is not monitored. \n\n" . $embedded_image);

        //email content
        // $mailer_response->addAddress($sender_email);
        $mailer_response->addAddress($email_no_reply);
        $mailer_response->isHTML(true);
        $mailer_response->Subject = $response_subject;
        $mailer_response->addEmbeddedImage("img/launch_logo_email.jpg", "launch_logo", "launch_logo");
        $mailer_response->Body = $response_message;

        $mailer_response->send();

        echo "<script>alert('Your application was sent successfully.')</script>";
    } else {
        echo "<script>alert('Unsupported File Type. PLease Upload PDF')</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Career oppurtunties at Launch Services LLC">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/styles-mobile.css">
    <script src="https://kit.fontawesome.com/e8bf802880.js" crossorigin="anonymous"></script>
    <script src="./script/script.js" defer></script>
    <title>Launch Services | Careers</title>
</head>

<body id="careers-body">
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
                    <li class="btn"><a href="contact.php">Contact</a></li>
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
                        <li class="btn"><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="careers-showcase" class="showcase">
            <div id="careers-showcase-content" class="showcase-content">
                <h1 class="primary-text"><span class="accent-text">Join</span> Our Team</h1>
            </div>
        </section>
        <section id="careers-form">
            <div class="container" id="careers-form-preface">
                <h2>Send us your resume and join our team!</h2>
            </div>
            <div class="careers-form">
                <form method="post" enctype="multipart/form-data">
                    <div class="container careers-form-divs" id="careers-name-inputs">
                        <label for="careersFirstName">First Name: </label>
                        <input type="text" id="careersFirstName" name="careersFirstName" placeholder="John" required><br>
                        <label for="careersLastName">Last Name: </label>
                        <input type="text" id="careersLastName" name="careersLastName" placeholder="Doe" required>
                    </div>
                    <div class="container careers-form-divs" id="careers-email-inputs">
                        <label for="careersEmail">Email: </label>
                        <input type="email" id="careersEmail" name="careersEmail" placeholder="john.doe@email.com" required>
                    </div>
                    <div class="container careers-form-divs" id="careers-phone-inputs">
                        <label for="careersPhone">Phone: </label>
                        <input type="number" id="careersPhone" name="careersPhone" placeholder="123-456-7890" required>
                    </div>
                    <div class="container careers-form-divs" id="careers-file-inputs">
                        <label for="careersFile">Upload Resume (.pdf)</label><br>
                        <input type="file" name="careersFile" id="careersFile" accept=".pdf" required />
                    </div>
                    <div class="container">
                        <button type="submit" class="btn dark-btn" id=careers_submit name="submit">Submit</button>
                        <button type="reset" class="btn dark-btn" name="reset">Reset</button>
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