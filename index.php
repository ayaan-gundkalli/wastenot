<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waste Not - Home</title>
    <link rel="stylesheet" href="css/style.css">
     <!--Google font poppins-->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>

    <!-- Header -->

    <header class="navbar">
      <div class="logo">Waste Not</div>
      <nav>
        <a href="#">Home</a>
        <a href="about.php">About</a>
        <a href="initiatives.php">Our Initiatives</a>
        <a href="login.php" class="btn filled">Login</a>
        <a href="signup.php" class="btn outlined">Signup</a>
      </nav>
    </header>

    <!-- alert of feedback submission -->
     <?php if (isset($_GET['feedback']) && $_GET['feedback'] == 'success'): ?>
  <script>alert("Thank you! Your feedback has been submitted.");</script>
<?php endif; ?>


    
    <!-- Hero Section -->

    <section class="hero">
      <div class="hero-image slider">
  <div class="slide active" style="background-image: url('images/mainbg.jpg');"></div>
  <div class="slide" style="background-image: url('images/mainbg2.jpg');"></div>
  <div class="slide" style="background-image: url('images/mainbg3.jpg');"></div>
     </div>

      <div class="hero-text">
        <h1>Ready to share food and help in build a community</h1>

        <div class="sub-content">
          <p class="subtitle">
            More than a platform, Waste Not is a movement to feed people, care
            for animals, and fight food waste — right in your neighborhood.
          </p>

          <div class="cta-buttons">
            <a href="lister/lister.php" class="btn filled">List Food</a>
            <a href="receiver/receiver.php" class="btn outlined">Find Food</a>
          </div>
        </div>

        <p class="note">
          Got extra food? Someone nearby needs it. <br />
          Who can use it: Restaurants, Events, Stalls, Home
        </p>
      </div>
    </section>
    <hr>

    <!-- how it works section -->

<div class="howitworks">
   <h2 id="how1">How it Works?</h2>
    <div class="steps">
        <div class="step"> <img src="images/step1.jpeg" alt="Step 1" class="step-img">
          <h3>1. List Your Food</h3>
          <p>List surplus food by clicking a image of the food that you wants to share</p>
        </div>
        <div class="step"> <img src="images/step2.1.jpg" alt="Step 2" class="step-img">
          <h3>2. Choose category</h3>
          <p>Choose whether the food is intended for People or Animals and mention food type aswell</p>
        </div>
        <div class="step"> <img src="images/step3.png" alt="Step 3" class="step-img">
          <h3>3. Arrange Pickup</h3>
          <p>Specify either the exact pickup location or provide the full address where the food should be collected.</p>
        </div>
        <div class="step"> <img src="images/lgo11.png" alt="Step 4" class="step-img">
          <h3>4. Make an Impact</h3>
          <p>Your food reaches those in need, helping to reduce waste and support our community.</p>
        </div>
</div>

    <!-- Impact Sections -->

  <section class="stats">
  <h3 id="how2">The Impact of Food Waste: What the Numbers Say</h3>
  <div class="impact-stats">
    <div class="impact-stat">
      <span class="impact-number">65M</span>
      <span class="impact-desc">tones of food<br>wasted annually</span>
    </div><hr>
    <div class="impact-stat">
      <span class="impact-number">₹90k</span>
      <span class="impact-desc">crore worth of<br>food wasted yearly</span>
    </div><hr>
    <div class="impact-stat">
      <span class="impact-number">40%</span>
      <span class="impact-desc">of food in India<br>is wasted</span>
    </div>
  </div>
</section>

    <!-- feedback/reviews section -->

  <?php
$conn = new mysqli("localhost", "root", "ayaan", "wastenot");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, message FROM feedback WHERE approved = 1 ORDER BY submitted_at DESC LIMIT 3";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0): ?>
  <div class="reviews">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="review">
        <p>“<?= htmlspecialchars($row['message']) ?>”</p>
        <span>– <?= htmlspecialchars($row['username']) ?></span>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <p>No feedback available yet.</p>
<?php endif; ?>

<br>
<br>
<br>
<br>

    <!-- Footer -->
     
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
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="initiatives.php">Our Initiatives</a></li>
        <li><a href="#">Terms and Conditions</a></li>
      </ul>
    </div>

    <div class="footer-help">
      <h4 class="footer-heading">Help</h4>
      <ul>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Feedback</a></li>
        <li><a href="#">Report a Bug</a></li>
      </ul>
    </div>

    <!-- Feedback Form -->
    <div class="footer-feedback">
      <h4 class="footer-heading">Leave Feedback</h4>
      <form action="feedback.php" method="POST" class="feedback-form">
        <input type="text" name="name" placeholder="Your Name" required class="form-input">
        <input type="email" name="email" placeholder="Your Email" required class="form-input">
        <textarea name="message" placeholder="Your Message..." required class="form-textarea"></textarea>
        <button type="submit" class="btn outlined">Send Message</button>
      </form>
    </div>

  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Waste Not. All rights reserved. | Made with care to reduce food waste and support the community.</p>
  </div>
</footer>

    <script src="script/slider.js">
</script>
  </body>
</html>
