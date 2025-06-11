<?php include '../actions/receiver_action.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receiver Dashboard</title>
  <link rel="stylesheet" href="../css/receiver.css">
   <!--Google font poppins-->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
  <!-- Hamburger Icon -->
<div class="hamburger">☰</div>

  <div class="dashboard-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
  <h2>Waste Not</h2>
  <p><?php echo htmlspecialchars($username); ?></p>
  <ul>
    <li><a href="../index.php">Home</a></li>
    <li><a href="../about.php">About Us</a></li>
    <li><a href="../lister/lister.php">what to share food?</a></li>
    <li><a href="../#how1">How it works?</a></li>
    <li><a href="../auth/logout.php">Logout</a></li>
  </ul>
</div>

    <!-- Main Area -->
<div class="main-area">
  <!-- Filter Row -->
  <div class="filter">
    <input type="text" id="searchInput" placeholder="Search" class="search-bar">
    <select id="typeSelect" class="type-select">
      <option value="">All Types</option>
      <option value="veg">Veg</option>
      <option value="non-veg">Non-Veg</option>
    </select>
    <button id="animalBtn" class="animal-btn">Animals</button>
  </div>

  <!-- Single listing container -->
  <div id="listingContainer" class="content">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="card">
        <img src="../uploads/<?php echo $row['food_image']; ?>" alt="Food Image">
        <div class="info">
          <p class="highlight"><?php echo $row['food_name']; ?></p>
           <?php if ($row['is_half_price'] == 1): ?>
          <span class="badge">Half Price</span>
          <?php else: ?>
          <span class="badgefree">Free</span>
          <?php endif; ?>

          <p>Type: <?php echo $row['food_type']; ?></p>
          <p><?php echo $row['descriptions']; ?></p>
          <p class="highlight">Address: <?php echo $row['address']; ?></p>
          <p>Pickup: <?php echo date('H:i', strtotime($row['pickup_start'])) . " - " . date('H:i', strtotime($row['pickup_end'])); ?></p>
          <?php
          $expiresAt = strtotime($row['expires_at']);
          $now = time();
          $hoursLeft = round(($expiresAt - $now) / 3600);
          $expiryText = $hoursLeft > 0 ? "Expires in {$hoursLeft} hrs" : "Expiring soon!";
          ?>
          <p id="phone">Contact No: <?php echo htmlspecialchars($row['contact_number']); ?></p>
          <span class="expiry-badge"><?php echo $expiryText; ?></span>
          <button class="openmap" onclick="openMapModal(<?php echo $row['latitude']; ?>, <?php echo $row['longitude']; ?>)">Open Map</button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
 </div> 
  </div>

  <!-- Map Modal -->
<div id="mapModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Location Map</h3>
      <span class="close" onclick="closeMapModal()">&times;</span>
    </div>
    <div id="leafletMap"></div>
    <div class="modal-footer">
      <button onclick="window.open('https://maps.google.com?q=...')">
        Open in Google Maps
      </button>
    </div>
  </div>
</div>

<script src="../script/filter.js"></script>
<script src="../script/rdashboard.js"></script>
<script src="../script/ham.js"></script>

<?php include '../includes/footer.php'; ?>
</body>
</html>
