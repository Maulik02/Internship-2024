<?php
require 'config/funtion.php';

if (isset($_POST['enquireBtn'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $service = validate($_POST['service']);
    $message = validate($_POST['message']);

    $query = "INSERT INTO enquires (name, email, phone, service, message) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $name, $email, $phone, $service, $message);
    $result = $stmt->execute();
    if ($result) {
        redirect('thank-you.php', 'Thank you for contacting us. We will get back to you soon.');
    } else {
        redirect('thank-you.php', 'Something went wrong');
    }
}
?>