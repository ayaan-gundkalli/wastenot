<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receiver') {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
$sql = "SELECT * FROM listing WHERE expires_at > '$current_time' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>