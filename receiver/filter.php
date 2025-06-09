<?php 
include '../db.php';

$conditions = [];
$params = [];
$types = "";

if (isset($_GET['animal']) && $_GET['animal'] == '1') {
    $conditions[] = "food_type = 'animal'";
    
}

if (!empty($_GET['type']) && in_array($_GET['type'], ['veg', 'non-veg'])) {
    $conditions[] = "food_type = ?";
    $params[] = $_GET['type'];
    $types .= 's';
}

if (!empty($_GET['search'])) {
    $conditions[] = "(food_name LIKE ? OR descriptions LIKE ?)";
    $params[] = '%' . $_GET['search'] . '%';
    $params[] = '%' . $_GET['search'] . '%';
    $types .= 'ss';
}

$sql = "SELECT * FROM listing";
if ($conditions) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}
$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="../uploads/' . htmlspecialchars($row['food_image']) . '" alt="Food Image">';
        echo '<div class="info">';
        echo '<h3>' . htmlspecialchars($row['food_name']) . '</h3>';
        echo '<p class="highlight">Food Type: ' . htmlspecialchars($row['food_type']) . '</p>';
        echo '<p>' . htmlspecialchars($row['descriptions']) . '</p>';
        echo '<p>Pickup: ' . date('H:i', strtotime($row['pickup_start'])) . " - " . date('H:i', strtotime($row['pickup_end'])) . '</p>';
        echo '<p id="phone">Contact No: ' . htmlspecialchars($row['contact_number']) . '</p>';
        echo '</div></div>';
    }
} else {
    echo '<p>No Food Available Yet! check back later</p>';
}
?>
