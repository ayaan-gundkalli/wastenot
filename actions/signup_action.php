<?php
session_start();
include '../db.php';

if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $userpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, userpassword, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $userpassword, $role);
        if ($stmt->execute()) {
              $_SESSION['user_id'] = $conn->insert_id;
              $_SESSION['username'] = $username;
              $_SESSION['role'] = $role;

        if ($role === 'lister') {
            header("Location: ../lister/lister.php");
        } else {
            header("Location: ../receiver/receiver.php");
        }
        exit();

       } else {
        echo "<script>alert('Error: Could not register.');</script>";
      }
    }
  }
?>