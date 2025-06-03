<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receiver') {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$sql = "SELECT * FROM listing ORDER BY created_at DESC";
$result = $conn->query($sql);
?>