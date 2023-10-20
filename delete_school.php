<?php
include("admin/config/dbcon.php");

if (isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];
    
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Perform the DELETE operation to remove the school from the approval table
        $deleteQuery = "DELETE FROM approval WHERE school_id='$school_id'";
        
        if ($conn->query($deleteQuery) === TRUE) {
            // Redirect back to the approval page after successful deletion
            header("Location: approval.php");
            exit;
        } else {
            echo "Error deleting record from approval: " . $conn->error;
        }
    } else {
        // Display the delete confirmation dialog using JavaScript
        echo '<script>
                var confirmed = confirm("Are you sure you want to delete this record?");
                if (confirmed) {
                    window.location.href = "'.$_SERVER['PHP_SELF'].'?school_id='.$school_id.'&confirm=yes";
                } else {
                    window.location.href = "school_approval.php";
                }
              </script>';
    }
} else {
    echo "Invalid parameters.";
}
?>
