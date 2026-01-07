<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all services
$services = $conn->query("SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Book a Service</h2>

    <?php while($service = $services->fetch_assoc()): ?>
    <div class="card mb-3 shadow">
        <div class="card-body">
            <h5><?= $service['service_name'] ?></h5>
            <p><?= $service['description'] ?></p>

            <form action="book_service.php" method="POST" class="mt-3">
                <input type="hidden" name="service_id" value="<?= $service['id'] ?>">

                <label>Date:</label>
                <input type="date" name="booking_date" required class="form-control mb-2">

                <label>Time:</label>
                <input type="time" name="booking_time" required class="form-control mb-2">

                <label>Address:</label>
                <textarea name="address" required class="form-control mb-2" placeholder="Your address"></textarea>

                <button type="submit" class="btn btn-primary w-100">Book Service</button>
            </form>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>
