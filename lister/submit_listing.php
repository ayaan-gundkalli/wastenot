<?php
session_start();
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
    $pickup_start = $_POST['pickupStart'];
    $pickup_end = $_POST['pickupEnd'];
    $expires_at = date("Y-m-d H:i:s", strtotime("+4 hours"));
    $contact_number = $_POST['contact'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $target_dir = "../uploads/";
    $image_name = basename($_FILES["foodImage"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;

    if (move_uploaded_file($_FILES["foodImage"]["tmp_name"], $target_file)) {
        $food_image = basename($target_file);
        $stmt = $conn->prepare("INSERT INTO listing (
    user_id, food_name, food_image, descriptions, address, food_type, pickup_start, pickup_end, contact_number,latitude, longitude, expires_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

         $stmt->bind_param("issssssssdds", $user_id, $food_name, $food_image, $descriptions, $address, $food_type,$pickup_start, $pickup_end, $contact_number,$latitude, $longitude, $expires_at);


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
