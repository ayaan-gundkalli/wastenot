<?php 
include '../includes/db.php';

// Set timezone and get current timestamp
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");

$conditions = [];
$params = [];
$types = "";

// Always add the expiry condition
$conditions[] = "expires_at > ?";
$params[] = $current_time;
$types .= 's';

// Filter: Animal button
if (isset($_GET['animal']) && $_GET['animal'] == '1') {
    $conditions[] = "food_type = 'animal'";
}

// Filter: Veg / Non-Veg dropdown
if (!empty($_GET['type']) && in_array($_GET['type'], ['veg', 'non-veg'])) {
    $conditions[] = "food_type = ?";
    $params[] = $_GET['type'];
    $types .= 's';
}

// Filter: Search text
if (!empty($_GET['search'])) {
    $conditions[] = "(food_name LIKE ? OR descriptions LIKE ?)";
    $params[] = '%' . $_GET['search'] . '%';
    $params[] = '%' . $_GET['search'] . '%';
    $types .= 'ss';
}

// Build final SQL query
$sql = "SELECT * FROM listing";
if ($conditions) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}
$sql .= " ORDER BY created_at DESC";

// Prepare and execute
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Output results
if ($result->num_rows > 0) {
    
 
 
 
 while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        
        if ((int)$row['is_half_price'] === 1) {
            echo '<span class="badge">Half Price</span>';
        } else {
            echo '<span class="badgefree">Free</span>';
        }

        echo '<img src="../uploads/' . htmlspecialchars($row['food_image']) . '" alt="Food Image">';

        echo '<div class="info">';
        echo '<p class="highlight">' . htmlspecialchars($row['food_name']) . '</p>';
        echo '<p>Type: ' . htmlspecialchars($row['food_type']) . '</p>';
        echo '<p>' . htmlspecialchars($row['descriptions']) . '</p>';
        echo '<p class="highlight">Address: ' . htmlspecialchars($row['address']) . '</p>';
        echo '<p>Pickup: ' . date('H:i', strtotime($row['pickup_start'])) . " - " . date('H:i', strtotime($row['pickup_end'])) . '</p>';

        $expiresAt = strtotime($row['expires_at']);
        $now = time();
        $hoursLeft = round(($expiresAt - $now) / 3600);
        $expiryText = $hoursLeft > 0 ? "Expires in {$hoursLeft} hrs" : "Expiring soon!";
        
        echo '<p id="phone">Contact No: ' . htmlspecialchars($row['contact_number']) . '</p>';
        echo '<span class="expiry-badge">' . $expiryText . '</span>';
        echo '<button class="openmap" onclick="openMapModal(' . $row['latitude'] . ', ' . $row['longitude'] . ')">Open Map</button>';
        echo '</div></div>';
      }

} else {
    echo '<p>No Food Available Yet! Check back later.</p>';
}
?>
