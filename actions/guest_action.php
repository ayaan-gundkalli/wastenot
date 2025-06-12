<?php
include '../includes/db.php';

$sql = "SELECT * FROM listing ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
?>