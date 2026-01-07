<?php
session_start();
require_once "config.php";

// Fetch services
$services = $conn->query("SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">ServiceBooking</a>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-light btn-sm">Login</a>
                <a href="register.php" class="btn btn-warning btn-sm">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero text-center text-white bg-primary py-5">
    <div class="container animate__animated animate__fadeIn">
        <h1 class="fw-bold">Book Trusted Services Easily</h1>
        <p class="lead">Fast • Reliable • Affordable</p>
    </div>
</section>

<!-- SERVICES -->
<section class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Our Services</h2>
    <div class="row g-4">

        <?php $modalCount=1; ?>
        <?php while($service = $services->fetch_assoc()): ?>
        <div class="col-md-4 animate__animated animate__fadeInUp">
            <div class="card service-card shadow">
                <img src="assets/images/<?= $service['image'] ?>" class="card-img-top" alt="<?= $service['service_name'] ?>">
                <div class="card-body text-center">
                    <h5><?= $service['service_name'] ?></h5>
                    <p><?= $service['description'] ?></p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal<?= $modalCount ?>">Book Service</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="bookModal<?= $modalCount ?>" tabindex="-1" aria-labelledby="bookModalLabel<?= $modalCount ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="book_service.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel<?= $modalCount ?>">Book <?= $service['service_name'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                      <label>Date:</label>
                      <input type="date" name="booking_date" required class="form-control mb-2">
                      <label>Time:</label>
                      <input type="time" name="booking_time" required class="form-control mb-2">
                      <label>Address:</label>
                      <textarea name="address" required class="form-control mb-2" placeholder="Your address"></textarea>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-success w-100">Book Service</button>
                  </div>
              </form>
            </div>
          </div>
        </div>

        <?php $modalCount++; ?>
        <?php endwhile; ?>

    </div>
</section>

<!-- FEEDBACK -->
<section class="feedback-section bg-light py-5">
  <div class="container">
    <h3 class="text-center fw-bold mb-3">Feedback</h3>
    <form class="feedback-form mx-auto" action="feedback_submit.php" method="POST">
      <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>
      <textarea name="feedback" class="form-control mb-2" placeholder="Your Feedback" required></textarea>
      <button class="btn btn-primary w-100">Submit</button>
    </form>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center p-3 mt-4">
  © 2026 ServiceBooking | Designed by Bhushan
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
