<?php
$current_year = date("Y");
?>
<link rel="stylesheet" href="../css/footer.css">
<footer>
  <div class="footer-container">
    <div class="footer-about">
      <h2 class="brand-name"><span class="brand-highlight">Wast</span>e Not</h2>
      <!-- <p>
        We provide a <strong>community-driven</strong> and <strong>purpose-built</strong> platform 
        to reduce food waste and connect those in need.
      </p> -->
    </div>

    <div class="footer-links">
      <h4 class="footer-heading">Useful Links</h4>
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
        <li><a href="../about.php">About Us</a></li>
        <li><a href="../initiatives.php">Our Initiatives</a></li>
      </ul>
    </div>

    <div class="footer-help">
      <h4 class="footer-heading">Help</h4>
      <ul>
        <li><a href="../contact.php">Contact Us</a></li>
        <li><a href="../#feedback">Feedback</a></li>
        <li><a href="../term.php">Terms and Conditions</a></li>

      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo $current_year; ?> Waste Not. All rights reserved. | Made with care to reduce food waste and support the community.</p>
  </div>
</footer>

