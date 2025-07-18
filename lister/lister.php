
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
    <!-- Hamburger Icon -->
<div class="hamburger">☰</div>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Waste Not</h2>
     <p class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>

      <nav>
        <a href="../index.php">home</a>
        <a href="../pages/initiatives.php">Our Initiative</a>
        <a href="../receiver/receiver.php">Looking for meal?</a>
        <a href="../#how1">How it Works?</a>

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

           <label for="is_half_price" class="half"> Offer at Half Price</label>
           <input type="checkbox" name="is_half_price" id="is_half_price" value="1">
          

          <label for="pickupTime">Pickup Time</label>
          From<input type="time" name="pickupStart" required>
          Till<input type="time" name="pickupEnd" required>


          <label for="contact">Contact Number</label>
          <input type="text" name="contact" id="contact" placeholder="Enter phone number" required>

          <label for="map">Mark Location (Map)</label>
          <div class="map-box"><div id="map"></div></div>
          <input type="hidden" name="latitude" id="latitude">
          <input type="hidden" name="longitude" id="longitude">

          <button type="submit" class="submit-btn">Submit</button>
        </form>
      
    </main>
<!-- listers history -->
    <aside class="details-sidebar">
      <h4>Listing Details:</h4>
      <div class="listing-grid">
<?php foreach ($listings as $item): ?>
  <?php $isExpired = strtotime($item['expires_at']) <= time(); ?>
  <div 
    class="card openModalBtn <?php echo $isExpired ? 'expired' : ''; ?>"
    data-id="<?= $item['id']; ?>"
    data-foodname="<?= htmlspecialchars($item['food_name']); ?>"
    data-foodtype="<?= htmlspecialchars($item['food_type']); ?>"
    data-description="<?= htmlspecialchars($item['descriptions']); ?>"
    data-address="<?= htmlspecialchars($item['address']); ?>"
    data-pickup="<?= htmlspecialchars(date('H:i', strtotime($item['pickup_start'])) . ' - ' . date('H:i', strtotime($item['pickup_end']))); ?>"
    data-contact="<?= htmlspecialchars($item['contact_number']); ?>"
    data-image="../uploads/<?= htmlspecialchars($item['food_image']); ?>"
    data-expires-at="<?= $item['expires_at']; ?>"
  >
    <img src="../uploads/<?= htmlspecialchars($item['food_image']); ?>" alt="Food Image">
    <p>
      <strong><?= htmlspecialchars($item['food_name']); ?></strong><br>
      <?= htmlspecialchars($item['food_type']); ?>
    </p>
  </div>
<?php endforeach; ?>

</div>
    </aside>
  </div>

  <script src="../script/ldashboard.js"></script>
  <script src="../script/leaflet.js"></script>
  <script src="../script/ham.js"></script>


<!-- Detail Modal -->
<div id="detailModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <div id="modalBody"></div>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="edit-modal" style="display:none;">
  <div class="edit-modal-content">
    <span class="edit-modal-close-btn" onclick="closeEditModal()">&times;</span>
    <div class="edit-modal-header">
      <h3 class="edit-modal-title">Edit Details</h3>
    </div>
    <div class="edit-modal-body" id="editModalBody">
    </div>
  </div>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
