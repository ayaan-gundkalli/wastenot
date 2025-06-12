

<?php
$servername = "sql101.infinityfree.com"; // Replace with your actual host
$username = "if0_39214059";      // Your InfinityFree DB username
$password = "NXv5a53LRmRf2e ";   // Found in the control panel
$dbname = "if0_39214059_wastenot_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
