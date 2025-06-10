<?php include '../actions/signup_action.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Signup | Waste Not</title>
  <link rel="stylesheet" href="../css/signup.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">Waste Not</div>
    <nav>
      <a href="../index.php">home</a>
      <a href="../about.php">about us</a>
      <a href="login.php" class="btn outlined">Login</a>
    </nav>
  </header>

  <!-- Signup Form -->
  <div class="signup-container">
    <form action="../actions/signup_action.php" method="POST" class="signup-form">
      <h2>Create An Account</h2>

      <input type="text" name="name" placeholder=" Enter username.." required />
      <input type="email" name="email" placeholder=" Enter email.." required />
      <input type="password" name="password" placeholder=" Enter new password.." required />

      <div class="role-select">
        <label>Your Role?</label>
        <label><input type="checkbox" name="role" value="lister" required> Lister</label>
        <label><input type="checkbox" name="role" value="receiver" required> Receiver</label>
      </div>

      <button type="submit" name="submit" class="btn fulled">Signup</button>
      <p class="login-link">Already a member? <a href="login.php">login</a></p>
    </form>
  </div>

</body>
</html>
