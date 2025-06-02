<?php
session_start();
include '../db.php';

// Check if receiver is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receiver') {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch all listings
$sql = "SELECT * FROM listing ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

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
    <div class="sidebar">
        <h2>Waste Not</h2>
        <p>🙍‍♂️   <?php echo htmlspecialchars($username); ?></p>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../lister/lister.php">Dashboard</a></li>
            <li><a href="../logout.php" style="color: white; text-decoration: none;">Logout</a></li>
        </ul>
    </div>

    
    <div class="content">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="../uploads/<?php echo $row['food_image']; ?>" alt="Food Image">
                <div class="info">
                    <p class="highlight">Food Type: <?php echo $row['food_type']; ?></p>
                    <p><?php echo $row['descriptions']; ?></p>
                    <p>Pickup: <?php echo date('H:i', strtotime($row['pickup_start'])) . " - " . date('H:i', strtotime($row['pickup_end'])); ?></p>

                    <p id="phone">contact no. <?php echo $row['contact_number']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>