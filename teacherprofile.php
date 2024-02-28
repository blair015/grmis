<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['user_role']) && isset($_SESSION['security_key'])) {
    // Session data exists, you can proceed with your logic here
    $userID = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    $user_security = $_SESSION['security_key'];

        // Your logic for handling the session data here
} else {
    // Session data is missing, redirect to index.php
    header("Location: http://202.137.126.58/");
    exit(0);
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include ("admin/includes/header.php");
include ("admin/includes/navbar.php");
include ("admin/includes/sidebar.php");
?>


<?php ("admin/includes/sidebar2.php"); ?>

                      <h1 class="mt-4">Teacher Profile</h1>
                        
<div>
            
    <main>
    <?php

include("admin/config/dbcon2.php");

// Assuming you have already set $user_name from the session

// Prepare the SQL statement
$sql = "SELECT emp_no FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($emp_no);
    $stmt->fetch();
    $stmt->close();
    if ($emp_no) {
        echo "";
    } else {
        echo "No result found for the provided email.";
    }
} else {
    
    echo "Error preparing the statement.";
}

$sql2 = "SELECT school_id FROM employment_record WHERE emp_no = ?";
$stmt2 = $conn->prepare($sql2);

if ($stmt2) {
    $stmt2->bind_param("s", $emp_no);
    $stmt2->execute();
    $stmt2->bind_result($school_id);
    $stmt2->fetch();
    $stmt2->close();
    if ($school_id) {
        echo "";
    } else {
        echo "No employment record found for the provided emp_no.";
    }
} else {
    echo "Error preparing the statement.";
}

?>
<?php
                                
                                $user_school_id = $school_id; 

                                echo "School ID:"." ".$school_id;
                                ?>
        <div class="container-fluid px-4">
        				<div class="card mb-4">
                               <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Position</th>
                                            <th>Address</th>
                                            <th>Sex</th>
                                            <th>Email Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Full Name</th>
                                            <th>Position</th>
                                            <th>Address</th>
                                            <th>Sex</th>
                                            <th>Email Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
        </div>
    </main>
   
</div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../assets/plugins/global/plugins.bundle.js"></script>
		<script src="../assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="../assets/js/custom/widgets.js"></script>
		<script src="../assets/js/custom/apps/chat/chat.js"></script>
		<script src="../assets/js/custom/modals/create-app.js"></script>
		<script src="../assets/js/custom/modals/upgrade-plan.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>

<?php
include('admin/includes/script.php');
include('admin/includes/footer.php');
?>
<script>
    $(document).ready(function () {
        var confirmApproval = confirm('Do you want to approve this school?');

        if (confirmApproval) {
            var schoolId = "<?php echo $_GET['school_id']; ?>";
            var schoolName = "<?php echo $_GET['school_name']; ?>";
            var schoolAddress = "<?php echo $_GET['school_address']; ?>";
            var district = "<?php echo $_GET['district']; ?>";
            var category = "<?php echo $_GET['category']; ?>";

            $.ajax({
                type: "POST",
                url: "approve_school.php",
                data: {
                    school_id: schoolId,
                    school_name: schoolName,
                    school_address: schoolAddress,
                    district: district,
                    category: category
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        // Show success SweetAlert and redirect
                        Swal.fire({
                            icon: 'success',
                            title: 'School Approved!',
                            text: 'The school has been successfully approved.',
                            showConfirmButton: false,
                            timer: 2000 // 2 seconds
                        }).then(function () {
                            window.location.href = 'school_approval.php';
                        });
                    } else {
                        // Handle the case when the server-side operation fails
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to approve the school. Server response: ' + response,
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle AJAX errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to communicate with the server. Error details: ' + errorThrown,
                    });
                }
            });
        } else {
            // Redirect back to the previous page on cancel
            window.location.href = 'approval.php';
        }
    });
</script>
