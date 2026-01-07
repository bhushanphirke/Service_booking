<?php
session_start();
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, feedback) VALUES (?, ?)");
    if(!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("ss",$name,$feedback);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Thank you for your feedback!');window.location='index.php';</script>";
}
?>
