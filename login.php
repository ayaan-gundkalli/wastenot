<?php
session_start();

$conn = new mysqli("localhost", "root", "ayaan", "wastenot");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for matching user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['userpassword'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'lister') {
                header("Location: lister/lister.php");
            } else {
                header("Location: receiver/receiver.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
<!-- login form -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Waste Not</title>
  <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/login.css"/>
</head>
<body>

  <header class="navbar">
    <div class="logo">Waste Not</div>
    <nav>
      <a href="index.php">home</a>
      <a href="about.php">about us</a>
      <a href="login.php" class="btn outlined">Login</a>
      <a href="signup.php" class="btn filled">Join</a>
    </nav>
  </header>

  <div class="login-box">
    <h2>Welcome Back</h2>
    <form method="POST" autocomplete="off">
  <input type="text" name="username" placeholder=" Enter Username.." required autocomplete="off">
  <input type="password" name="password" placeholder=" Enter Password.." required>
  <div class="forgot">forgot password?</div>
  <button type="submit" name="submit">login</button>
  <div class="signup-link">Don’t have an account? <a href="signup.php">Signup</a></div>
</form>
  </div>

</body>
</html>
