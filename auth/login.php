<?php include '../actions/login_action.php'; ?>

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
    <link rel="stylesheet" href="../css/login.css"/>
</head>
<body>

  <header class="navbar">
    <div class="logo">Waste Not</div>
    <nav>
      <a href="../index.php">home</a>
      <a href="../about.php">about us</a>
      <a href="signup.php" class="btn filled">Signup</a>
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
