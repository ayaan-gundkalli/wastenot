<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$listing_id = $_GET['id'];

$sql = "DELETE FROM listing WHERE listing_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $listing_id, $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: lister.php");
exit();
?>
