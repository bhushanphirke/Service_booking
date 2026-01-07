<?php
include 'config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "Admin"){
    die("Access Denied");
}

$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as count FROM bookings"))['count'];
$completed = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as count FROM bookings WHERE status='Completed'"))['count'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <h2>Admin Dashboard</h2>

  <div class="row my-4">
    <div class="col-md-4">
      <div class="card text-bg-primary shadow p-3">
        <h5>Total Bookings</h5>
        <h2><?php echo $total; ?></h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-bg-success shadow p-3">
        <h5>Completed</h5>
        <h2><?php echo $completed; ?></h2>
      </div>
    </div>
  </div>
  <a href="index.php" class="btn btn-secondary mt-4">Back to Home</a>
</div>
</body>
</html>
