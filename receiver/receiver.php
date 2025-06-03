<?php include '../actions/receiver_action.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receiver Dashboard</title>
  <link rel="stylesheet" href="../css/receiver.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="dashboard-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Waste Not</h2>
      <p><?php echo htmlspecialchars($username); ?></p>
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="receiver.php">Dashboard</a></li>
        <li><a href="../lister/lister.php">Lister Dashboard</a></li>
        <li><a href="../auth/logout.php" style="color: white; text-decoration: none;">Logout</a></li>
      </ul>
    </div>

    <!-- Main Area -->
    <div class="main-area">
      <!-- Filter Row -->
      <div class="filter">
        <input type="text" placeholder="search" class="search-bar">
        <select class="type-select">
          <option>types</option>
          <option value="veg">Veg</option>
          <option value="non-veg">Non-Veg</option>
          <option value="animal">For Animals</option>
        </select>
        <button class="animal-btn">animals</button>
      </div>

      <!-- Listing Cards -->
      <div class="content">
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="card">
            <img src="../uploads/<?php echo $row['food_image']; ?>" alt="Food Image">
            <div class="info">
              <p class="highlight">Food Type: <?php echo $row['food_type']; ?></p>
              <p><?php echo $row['descriptions']; ?></p>
              <p>Pickup: <?php echo date('H:i', strtotime($row['pickup_start'])) . " - " . date('H:i', strtotime($row['pickup_end'])); ?></p>
              <p id="phone">Contact No: <?php echo $row['contact_number']; ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</body>
</html>
