<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "ayaan", "wastenot");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Clean inputs
    $username = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Prepare and execute insert
    $stmt = $conn->prepare("INSERT INTO feedback (username, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $message);

    if ($stmt->execute()) {
        // Redirect to avoid resubmission
        header("Location: index.php?feedback=success");
        exit();
    } else {
        echo "<script>alert('Error submitting feedback.'); window.location.href='index.php';</script>";
    }
}
?>
