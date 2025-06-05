<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO feedback (username, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $message);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Error submitting feedback.'); window.location.href='../index.php';</script>";
    }
}
?>
