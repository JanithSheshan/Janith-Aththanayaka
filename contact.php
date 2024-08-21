<?php
session_start();

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get data from form and sanitize
$name = sanitize_input($_POST['name']);
$email = sanitize_input($_POST['email']);
$subjectnew = sanitize_input($_POST['subjectnew']);
$message = sanitize_input($_POST['message']);
$to = "janithaththanayaka06@gmail.com";
$subject = "Mail From website:";
$txt = "Name: " . $name . "\n\nEmail: " . $email . "\n\nSubject: " . $subjectnew . "\n\nMessage:\n" . $message;
$headers = "From: noreply@janithaththanayaka.com\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_message'] = "Invalid email format.";
    header("Location: index.html#contact");
    exit();
}

// Check if fields are not empty
if (!empty($name) && !empty($email) && !empty($subjectnew) && !empty($message)) {
    // Send email
    if (mail($to, $subject, $txt, $headers)) {
        $_SESSION['success_message'] = "Message sent successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to send message. Please try again later.";
    }
} else {
    $_SESSION['error_message'] = "All fields are required.";
}

// Redirect
header("Location: index.html#contact");
?>

