
<?php include '../actions/lister_action.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lister Dashboard - Waste Not</title>
  <link rel="stylesheet" href="../css/lister.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Waste Not</h2>
     <p class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>

      <nav>
        <a href="../index.php">home</a>
        <a href="../receiver/receiver.php">Dashboard</a>
        <a href="#">Lister Dashboard</a>
      </nav>
      <a href="../auth/logout.php" class="logout">Logout</a>
    </aside>

    <!-- Main Content -->
    <main class="main-section">
      <!-- Upload Form -->
      <section class="upload-form">
        <h3>Upload Food Listing</h3>
        <form action="submit_listing.php" method="post" enctype="multipart/form-data">
          <label for="foodImage">Upload Photo</label>
          <input type="file" name="foodImage" id="foodImage" accept="image/*" required>

          <label for="description">Description & Address</label>
          <textarea name="description" id="description" placeholder="Type food description and pickup address..." required></textarea>

          <label for="foodType">Food Type</label>
          <select name="foodType" id="foodType" required>
            <option value="veg">Veg</option>
            <option value="non-veg">Non-Veg</option>
            <option value="animal">For Animals</option>
          </select>

          <label for="pickupTime">Pickup Time</label>
         <input type="time" name="pickupStart" required>
<input type="time" name="pickupEnd" required>


          <label for="contact">Contact Number</label>
          <input type="text" name="contact" id="contact" placeholder="Enter phone number" required>

          <label for="map">Mark Location (Map)</label>
          <div id="map" class="map-box">[Map will load here]</div>
          <input type="hidden" name="latitude" id="latitude">
          <input type="hidden" name="longitude" id="longitude">

          <button type="submit" class="submit-btn">Submit</button>
        </form>
      
    </main>

    <aside class="details-sidebar">
      <h4>Listing Details:</h4>
      <div class="listing-grid">
  <?php foreach ($listings as $item): ?>
    <div class="card" onclick="showDetails(
      '<?php echo $item['listing_id']; ?>',
      '<?php echo addslashes($item['food_type']); ?>',
      '<?php echo addslashes($item['descriptions']); ?>',
      '<?php echo addslashes(date('H:i', strtotime($item['pickup_start'])) . ' - ' . date('H:i', strtotime($item['pickup_end']))); ?>',
      '<?php echo addslashes($item['contact_number']); ?>',
      '../uploads/<?php echo $item['food_image']; ?>'
    )">
      <img src="../uploads/<?php echo htmlspecialchars($item['food_image']); ?>" alt="Food Image">
      <p>
        <strong><?php echo $item['food_type']; ?></strong><br>
        <?php echo $item['descriptions']; ?>
      </p>
    </div>
  <?php endforeach; ?>
</div>
    </aside>
  </div>

  <script src="../script/ldashboard.js"></script>
<!-- Modal Container -->
<div id="detailModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <div id="modalBody"></div>
  </div>
</div>


</body>
</html>
