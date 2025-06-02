<?php
session_start();
// Database connection
$conn = new mysqli("localhost", "root", "ayaan", "wastenot");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $userpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        // Insert with updated field names
        $stmt = $conn->prepare("INSERT INTO users (username, email, userpassword, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $userpassword, $role);
        if ($stmt->execute()) {
              $_SESSION['user_id'] = $conn->insert_id;
              $_SESSION['username'] = $username;
              $_SESSION['role'] = $role;

        if ($role === 'lister') {
            header("Location: lister/lister.php");
        } else {
            header("Location: receiver/receiver.php");
        }
        exit();

       } else {
        echo "<script>alert('Error: Could not register.');</script>";
      }
    }
  }
?>






<!-- signup page -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Signup | Waste Not</title>
  <link rel="stylesheet" href="css/signup.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">Waste Not</div>
    <nav>
      <a href="index.php">home</a>
      <a href="about.php">about us</a>
      <a href="login.php" class="btn outlined">Login</a>
      <a href="signup.php" class="btn filled">Join</a>
    </nav>
  </header>

  <!-- Signup Form -->
  <div class="signup-container">
    <form action="signup.php" method="POST" class="signup-form">
      <h2>Signup/Register</h2>

      <input type="text" name="name" placeholder=" Enter username.." required />
      <input type="email" name="email" placeholder=" Enter email.." required />
      <input type="password" name="password" placeholder=" Enter new password.." required />

      <div class="role-select">
        <label>Your Role?</label>
        <label><input type="radio" name="role" value="lister" required> Lister</label>
        <label><input type="radio" name="role" value="receiver" required> Receiver</label>
      </div>

      <button type="submit" name="submit" class="btn fulled">Signup</button>
      <p class="login-link">Already a member? <a href="login.php">login</a></p>
    </form>
  </div>

</body>
</html>
