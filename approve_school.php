    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include("admin/config/dbcon.php");

// Define a variable to store the error message
$errorMsg = "";

if (isset($_GET['school_id'], $_GET['school_name'], $_GET['school_address'], $_GET['district'], $_GET['category'])) {
    $school_id = $_GET['school_id'];
    $school_name = $_GET['school_name'];
    $school_address = $_GET['school_address'];
    $district = $_GET['district'];
    $category = $_GET['category'];

    // Check if the school_id already exists in the school_profile table
    $checkQuery = "SELECT school_id FROM school_profile WHERE school_id = '$school_id'";
    $result = $conn->query($checkQuery);

    if (!$result) {
        $errorMsg = "Error checking for existing school ID: " . $conn->error;
    }

    if ($result->num_rows > 0) {
        // School ID already exists, set the error message
        $errorMsg = "School ID already exists. Data not saved.";
    } else {
        // School ID does not exist, perform the INSERT operation into the school_profile table
        $insertQuery = "INSERT INTO school_profile (school_id, school_name, school_address, district, category) VALUES ('$school_id', '$school_name', '$school_address', '$district', '$category')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // If the insert was successful, proceed to delete the corresponding row from the approval table
            $deleteQuery = "DELETE FROM approval WHERE school_id = '$school_id'";
            
            if ($conn->query($deleteQuery) === TRUE) {
                $errorMsg = "Record inserted in school_profile and deleted from approval successfully.";
            } else {
                $errorMsg = "Error deleting record from approval: " . $conn->error;
            }
        } else {
            $errorMsg = "Error inserting record into school_profile: " . $conn->error;
        }
    }
} else {
    $errorMsg = "Invalid parameters.";
}

// Remove the page redirection for testing purposes
// header("Location: approval.php");
// exit;
?>

<script>
        $(document).ready(function(){
            // Check if the error message is not empty, then display the toast
            <?php if (!empty($errorMsg)) { ?>
                $("#errorToast").toast({ autohide: false });
                $("#errorToast").toast("show");
            <?php } ?>
        });
    </script>

    