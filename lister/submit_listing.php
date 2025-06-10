<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }
    $user_id = $_SESSION['user_id'];
    $food_name = $_POST['foodname'];
    $descriptions = $_POST['description'];
    $address = $_POST['address'];
    $food_type = $_POST['foodType'];
    $is_half_price = isset($_POST['is_half_price']) ? 1 : 0;
    $pickup_start = $_POST['pickupStart'];
    $pickup_end = $_POST['pickupEnd'];
    $expires_at = date("Y-m-d H:i:s", strtotime($pickup_end)); //working
    $contact_number = $_POST['contact'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $target_dir = "../uploads/";
    $image_name = basename($_FILES["foodImage"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;

    if (move_uploaded_file($_FILES["foodImage"]["tmp_name"], $target_file)) {
        $food_image = basename($target_file);
        $stmt = $conn->prepare("INSERT INTO listing (
    user_id, food_name, food_image, descriptions, address, food_type, pickup_start, pickup_end, contact_number,latitude, longitude, expires_at, is_half_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

         $stmt->bind_param("issssssssddsi", $user_id, $food_name, $food_image, $descriptions, $address, $food_type, $pickup_start, $pickup_end, $contact_number, $latitude, $longitude, $expires_at, $is_half_price);


        if ($stmt->execute()) {
            header("Location: lister.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload image.";
    }

    $conn->close();
}
?>
