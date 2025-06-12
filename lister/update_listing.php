<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized");
    }

    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $food_name = $_POST['foodname'];
    $descriptions = $_POST['description'];
    $address = $_POST['address'];
    $food_type = $_POST['foodType'];

    $contact = $_POST['contact'];

    $stmt = $conn->prepare("UPDATE listing SET 
      food_name = ?, descriptions = ?, address = ?, food_type = ?, 
      contact_number = ?
      WHERE listing_id = ? AND user_id = ?");

    $stmt->bind_param("sssssii", $food_name, $descriptions, $address, $food_type,
        $contact, $id, $user_id);

    if ($stmt->execute()) {
        echo "Listing updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
