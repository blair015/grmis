<?php
$servername = "202.137.126.61";
$username = "root";
$password = "@vert2023";
$dbname = "db_a5093a_vertdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";
// Close the connection

?>

<hello>