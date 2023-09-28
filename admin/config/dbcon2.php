<?php
$servername = "localhost";
$username = "root";
$password = "@DavaosurDB2023";
$dbname = "tis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";
// Close the connection

?>