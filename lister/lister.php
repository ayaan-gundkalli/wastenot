
<?php include '../actions/lister_action.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lister Dashboard - Waste Not</title>
  <link rel="stylesheet" href="../css/lister.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
          <label for="foodname">Enter Food Name</label>
          <input type="text" name="foodname" placeholder="Enter food name" required>

          <label for="description">Description</label>
          <textarea name="description" id="description" placeholder="Type food description" required></textarea>
          <label for="address">Address</label>
          <input type="text" name="address" placeholder="Provide Address" required>

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
          <div class="map-box"><div id="map"></div></div>
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
      '<?php echo addslashes($item['food_name']); ?>',
      '<?php echo addslashes($item['food_type']); ?>',
      '<?php echo addslashes($item['descriptions']); ?>',
      '<?php echo addslashes($item['address']); ?>',
      '<?php echo addslashes(date('H:i', strtotime($item['pickup_start'])) . ' - ' . date('H:i', strtotime($item['pickup_end']))); ?>',
      '<?php echo addslashes($item['contact_number']); ?>',
      '../uploads/<?php echo $item['food_image']; ?>'
    )">
      <img src="../uploads/<?php echo htmlspecialchars($item['food_image']); ?>" alt="Food Image">
      <p>
        <strong><?php echo $item['food_name']; ?></strong><br>
        <?php echo $item['food_type']; ?>
      </p>
    </div>
  <?php endforeach; ?>
</div>
    </aside>
  </div>

  <script src="../script/ldashboard.js"></script>
  <script src="../script/leaflet.js"></script>

<!-- Modal Container -->
<div id="detailModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <div id="modalBody"></div>
  </div>
</div>


</body>
</html>
