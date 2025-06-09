<?php
include __DIR__. '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if ($full_name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO contactus (full_name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $message);
        $stmt->execute();
        $stmt->close();
        header("Location: ../index.php?success=1");
    } else {
        header("Location: ../index.php?error=1");
    }
    $conn->close();
}
?>