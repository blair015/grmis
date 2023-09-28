<?php
include("admin/config/dbcon.php");

// Query to count rows in your table
$sql = "SELECT COUNT(*) as row_count FROM approval"; // Change "your_table" to your actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the count
    $row = $result->fetch_assoc();
    $rowCount = $row["row_count"];
    
    // Close the database connection
    $conn->close();
} else {
    echo "No records found";
    // Close the database connection
    $conn->close();
}
?>