

<?php
// get_school_info.php

// Include the database connection
include("admin/config/dbcon.php");

function getSchoolInfo($school_id) {
    global $conn;

    // Fetch the specific school's information from the database based on the school ID
    $query = "SELECT * FROM school_profile WHERE school_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $school_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Retrieve the school details
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return false; // No data found
    }
    
}
?>
<?php
// Include necessary files and connect to the database
include('admin/includes/script.php');
include('admin/config/dbcon.php');

$statusMsg = ''; // Initialize status message

// Check if the form has been submitted
if (isset($_POST['save_changes'])) {

    // Retrieve form data for school information
    $District = $_POST['district'];
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $school_address = $_POST['school_address'];
    $contact_number = $_POST['contact_number'];
    $category = $_POST['category'];
    $school_email = $_POST['school_email'];

    // Check if files were uploaded successfully
    if (isset($_FILES['school_logo']['tmp_name']) && isset($_FILES['school_header']['tmp_name'])) {
        // Generate unique filenames for the uploaded files
        $school_logo_filename = uniqid() . '_' . $_FILES['school_logo']['name'];
        $school_header_filename = uniqid() . '_' . $_FILES['school_header']['name'];

        // Move the uploaded files to the desired folder
        $uploadsDirectory = 'uploads/'; // Path to the folder where you want to save the images
        $school_logo_path = $uploadsDirectory . $school_logo_filename;
        $school_header_path = $uploadsDirectory . $school_header_filename;

        if (
            move_uploaded_file($_FILES['school_logo']['tmp_name'], $school_logo_path) &&
            move_uploaded_file($_FILES['school_header']['tmp_name'], $school_header_path)
        ) {
            // Files were successfully moved
            // Update data in the database including the file paths
                    $sql = "UPDATE school_profile SET 
                    school_name = ?,
                    school_address = ?,
                    school_email_address = ?,
                    school_logo = ?,
                    school_header = ?,
                    contact_number =?,
                    District = ?,
                    category = ?
                    WHERE school_id = ?";

                    // Use prepared statements to avoid SQL injection
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssss",
                    $school_name,
                    $school_address,
                    $school_email,
                    $school_logo_path,
                    $school_header_path,
                    $contact_number,
                    $District,
                    $category,
                    $school_id
                    );

                    $sql_run = mysqli_stmt_execute($stmt);

            if ($sql_run) {
                $statusMsg = "School Information Updated Successfully.";
            } else {
                $statusMsg = "Error! School Information Not Updated.";
            }
        } else {
            // Handle file upload errors here
            $statusMsg = "Error! File Upload Failed.";
        }
    } else {
        // Handle the case where files were not properly uploaded
        $statusMsg = "Error! File Upload Failed.";
    }
}

// Display status message and redirect
echo $statusMsg;
echo "<script>
    if (confirm('{$statusMsg} Back to Profile?')) {
        window.location.href = 'schoolprofile.php?school_id={$school_id}';
    } else {
        // Handle the case where the user chooses not to proceed
        window.location.href = 'schoolprofile.php?school_id={$school_id}'; // You can modify this URL as needed
    }
</script>";
?>

<script>
// JavaScript function to show a success toast
function showSuccessToast() {
    const toast = document.getElementById('successToast');
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    setTimeout(function() {
        window.location.href = "overview.php";
    }, 5000); // Redirect after 5 seconds
}

// JavaScript function to show an error toast
function showErrorToast() {
    const toast = document.getElementById('errorToast');
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    setTimeout(function() {
        window.location.href = "overview.php";
    }, 5000); // Redirect after 5 seconds
}
</script>


<!-- Bootstrap Toast for success message -->
<div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-success text-white">
        <strong class="me-auto">Success</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        School Information Added Successfully
    </div>
</div>

<!-- Bootstrap Toast for error message -->
<div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-danger text-white">
        <strong class="me-auto">Error</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        School Information Not Added
    </div>
</div>


<?php
include ('admin/config/dbcon.php');

if (isset($_POST['update_pf'])) {
    // Get the input values from the form
    $school_id = $_POST['school_id'];
    $academic_classroom = $_POST['academic_classroom'];
    $non_academic_classroom = $_POST['non_academic_classroom'];
    $needing_repair = $_POST['needing_repair'];
    $tls = $_POST['tls'];
    $makeshift = $_POST['makeshift'];
    $arms_and_chairs = $_POST['arms_and_chairs'];
    $tables_and_chairs = $_POST['tables_and_chairs'];
    $functional_clinic = $_POST['functional_clinic'];
    
    // Prepare the update query
    $sql = "UPDATE school_profile SET 
            academic_classroom = '$academic_classroom', 
            non_academic_classroom = '$non_academic_classroom', 
            needing_repair = '$needing_repair', 
            tls = '$tls', 
            makeshift = '$makeshift', 
            arms_and_chairs = '$arms_and_chairs', 
            tables_and_chairs = '$tables_and_chairs', 
            functional_clinic = '$functional_clinic' 
            WHERE school_id = '$school_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
        echo '<script type="text/javascript">';
        echo 'Swal.fire({
                icon: "success",
                title: "Success!",
                text: "School Information Updated Successfully",
                showConfirmButton: false,
                timer: 5000
              }).then(function() {
                window.location.href = "overview.php";
              });';
        echo '</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

//$conn->close();
?>



<!-- <?php
//if (isset($_GET['municipality'])) {
    $municipality = $_GET['municipality'];

    // Simulated data, you can replace this with your actual data source
    $districtOptions = array();
    if ($municipality == 'BANSALAN') {
        $districtOptions = array('MATANAO I', 'MATANAO II');
    } elseif ($municipality == 'SANTA CRUZ') {
        $districtOptions = array('SOUTH', 'NORTH');
    }

    foreach ($districtOptions as $district) {
        echo "<option value='$district'>$district</option>";
    }
//}
?> -->
