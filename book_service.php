<?php
session_start();
require_once "config.php";
require_once "mail.php";

if (!isset($_SESSION['user_id'])) {
    die("Login required");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id    = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $date       = $_POST['booking_date'];
    $time       = $_POST['booking_time'];
    $address    = $_POST['address'];

    // Insert booking
    $sql = "INSERT INTO bookings (user_id, service_id, booking_date, booking_time, address)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) { die("Prepare failed: " . $conn->error); }
    $stmt->bind_param("iisss", $user_id, $service_id, $date, $time, $address);
    $stmt->execute();
    $stmt->close();

    // Get service name
    $stmt = $conn->prepare("SELECT service_name FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    // Send email to fixed admin
    $mailSent = sendBookingMail(
        "alkaphirke001@gmail.com",           // fixed admin email
        $data['service_name'],
        $_SESSION['name'],
        $_SESSION['email'],
        $date,
        $time,
        $address
    );

    if ($mailSent) {
        echo "<script>alert('Service booked successfully. Email sent to admin.');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Service booked successfully, but email failed.');window.location='index.php';</script>";
    }
}
?>
