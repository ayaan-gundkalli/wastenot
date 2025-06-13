

<?php
$servername = "sql101.infinityfree.com"; 
$username = "if0_39214059";      
$password = "NXv5a53LRmRf2e "; 
$dbname = "if0_39214059_wastenot_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
