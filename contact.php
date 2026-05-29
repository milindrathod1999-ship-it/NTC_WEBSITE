<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Validate captcha
$submitted = intval($_POST['captcha'] ?? '');
$expected  = intval($_SESSION['captcha_answer'] ?? -1);
if ($submitted !== $expected) {
    echo json_encode(['success' => false, 'message' => 'Incorrect answer — please refresh and try again.']);
    exit;
}
unset($_SESSION['captcha_answer']); // one-time use

// Sanitize inputs
$name     = htmlspecialchars(strip_tags(trim($_POST['name']     ?? '')));
$company  = htmlspecialchars(strip_tags(trim($_POST['company']  ?? '')));
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$interest = htmlspecialchars(strip_tags(trim($_POST['interest'] ?? '')));
$message  = htmlspecialchars(strip_tags(trim($_POST['message']  ?? '')));

// Validate required fields
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

// Build email
$to      = 'milindrathod1999@gmail.com';
$subject = 'New Enquiry from ' . $name . ($company ? " ($company)" : '');
$body    = "Name:    $name\n"
         . "Company: $company\n"
         . "Email:   $email\n"
         . "Category: $interest\n\n"
         . "Message:\n$message\n";

$headers = "From: noreply@napoleontextile.com\r\n"
         . "Reply-To: $email\r\n"
         . "X-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Thank you — we will be in touch within 24 hours.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Sorry, the message could not be sent. Please email us directly.']);
}
