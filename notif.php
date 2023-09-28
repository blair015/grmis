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

<!DOCTYPE html>
<html>
<head>
    <title>Notification Bell</title>
    <!-- Include FontAwesome CSS for the bell icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Add your CSS styling for the notification bell icon here -->
    <style>
        /* Example CSS for the notification bell icon */
        .notification-bell {
            position: relative;
            display: inline-block;
        }

        .notification-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <!-- Notification bell icon -->
    <div class="notification-bell">
        <i class="fa fa-bell"></i>
        <span class="notification-badge"><?php echo $rowCount; ?></span>
    </div>
</body>
</html>
