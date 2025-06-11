<?php include 'actions/guest_action.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Food Listings | Waste Not</title>
  <link rel="stylesheet" href="css/guest.css">
   <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

</head>
<body>
  <header class="main-header">
    <div class="logo-container">
      <a href="index.php" class="logo-link">
        <span class="logo-text">WasteNot</span>
      </a>
    </div>
  </header>

  <div class="container">
    <div class="header">
      <h1>Find Free Food in Your Community</h1>
      <p class="subtitle">Browse recently shared food items from local donors. Join Waste Not to claim these items and help reduce food waste.</p>
    </div>

    <div class="guest-message">
      <h3>You're viewing as a guest</h3>
      <p>Create an account or login to claim these food items and connect with donors in your area.</p>
    </div>

    <div class="card-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
          <img src="uploads/<?php echo htmlspecialchars($row['food_image']); ?>" alt="<?php echo htmlspecialchars($row['food_name']); ?>">
          <div class="card-content">
            <h3 class="card-title"><?php echo htmlspecialchars($row['food_name']); ?></h3>
            <p class="card-detail"><strong>Type:</strong> <?php echo htmlspecialchars($row['food_type']); ?></p>
            <p class="card-detail"><?php echo htmlspecialchars($row['descriptions']); ?></p>
            
            <div class="card-divider"></div>
            
            <p class="card-detail"><strong>📍 Location:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
            <p class="card-detail"><strong>⏰ Pickup Window:</strong> <?php echo htmlspecialchars($row['pickup_start']); ?> - <?php echo htmlspecialchars($row['pickup_end']); ?></p>
            <p class="card-detail"><strong>📞 Contact:</strong> <?php echo isset($row['contact']) ? $row['contact'] : 'Available after login'; ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="guest-cta">
      <a href="auth/signup.php" class="btn-primary">Join Waste Not</a>
      <a href="auth/login.php" class="btn-secondary">I Already Have an Account</a>
      <!-- <a href="index.php" class="btn-primary">Waste Not</a> -->
    </div>
  </div>
</body>
</html>