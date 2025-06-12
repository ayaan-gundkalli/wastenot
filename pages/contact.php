<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waste Not - contact us</title>
    <link rel="stylesheet" href="../css/contact.css">
     <!--Google font poppins-->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
</head>
    <header class="navbar">
        <div class="logo">Waste Not</div>
        <nav>
        <a href="../index.php">home</a>
        <a href="about.php">about us</a>
        <a href="../auth/signup.php" class="btn outlined">Signup</a>
        </nav>
    </header>
<body>
    <div class="container">
    <h2>Contact Us</h2>
    <form method="POST" action="../actions/contact_action.php">
        <div class="form">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="form">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="form">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" name="submitcontact" class="btn btn-primary">Submit</button>
    </form>
</div>
<footer>
  <div class="footer-container">
    <div class="footer-about">
      <h2 class="brand-name"><span class="brand-highlight">Wast</span>e Not</h2>
      <p>
        We provide a <strong>community-driven</strong> and <strong>purpose-built</strong> platform 
        to reduce food waste and connect those in need.
      </p>
    </div>

    <div class="footer-links">
      <h4 class="footer-heading">Useful Links</h4>
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../auth/login.php">Login</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="initiatives.php">Our Initiatives</a></li>
      </ul>
    </div>

    <div class="footer-help">
      <h4 class="footer-heading">Help</h4>
      <ul>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="../#feedback">Feedback</a></li>
        <li><a href="term.php">Terms and Conditions</a></li>

      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Waste Not. All rights reserved. | Made with care to reduce food waste and support the community.</p>
  </div>
</footer>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let msg = "<?php echo $_SESSION['status'] ?? ''; ?>";
        if(msg !== '') {
            Swal.fire({
                title: "Thank you",
                text: msg,
                icon: "success"
            });
            <?php unset($_SESSION['status']); ?>
        }
    </script>
</body>
</html>
