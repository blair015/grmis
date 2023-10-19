

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include ("admin/includes/header.php");
include ("admin/includes/navbar.php");
include ("admin/includes/sidebar.php");
?>


<?php ("admin/includes/sidebar2.php"); ?>

                      <h1 class="mt-4">Database of District in Divison of Davao del Sur</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">List of District</li>
                        </ol>
<div>
            
    <main>
        <div class="container-fluid px-4">
        				<div class="card mb-4">
                        <?php


                            // Check if user_role is "teacher"
                            if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Admin' || $_SESSION['user_role'] === 'Planning' || $_SESSION['user_role'] === 'SDS')) {
                                // User is a teacher, show the gear icon
                               echo '<div class="card-header">';
                                echo 'Your school is not in the list?';
                                echo '<span class="float-right">';
                                echo '<button id="openModalButton" data-toggle="modal" data-target="#myModal" style="background-color: blue; border: none; color: white; font-size: 24px; padding: 5px 10px;">
                                    <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add School
                                </button>';
                                echo '</span>';
                                echo '</div>';

                            } else {
                                // User is not a teacher, hide the gear icon
                                echo '<div class="card-header">';
                                echo 'Your school not in the list?';
                                echo '</div>';
                            }
                            ?>
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


                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>District ID</th>
                                            <th>Name of District</th>
                                            <th>Address</th>
                                            <th>Total Number of Schools</th>
                                            <th>PSDS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>District ID</th>
                                            <th>Name of District</th>
                                            <th>Address</th>
                                            <th>Total Number of Schools</th>
                                            <th>PSDS</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                
                                $user_school_id = $school_id; 
                                echo $user_school_id; ?>
                                
                                <?php
                                    

                                include ("admin/config/dbcon.php");

                                $query = "SELECT * FROM district_profile";
                                $result = $conn->query($query);
                                    // Loop through the fetched data and populate the table rows
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['district_id'] . "</td>";
                                            echo "<td>" . $row['district_name'] . "</td>";
                                            echo "<td>" . $row['district_address'] . "</td>";
                                            echo "<td>" . $row['district_email'] . "</td>";
                                            echo "<td>" . $row['total_school'] . "</td>";
                                            echo "<td>
                                            <a href='schoolprofile.php?school_id=" . $row['school_id'] . "&user_school_id=" . $user_school_id . "'><i class='fas fa-eye fa-2x'></i></a>
                                                 </td>";
                                        

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data available</td></tr>";
                                    }
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
        </div>
    </main>

    <form action="save_school.php" method="POST">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                        <div class="modal-header" style="background-color: blue; color: white;">
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fas fa-plus-circle" style="margin-right: 10px;"></i> Add School
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
            
        <?php
        include("admin/config/dbcon2.php");

        $sql = "SELECT * FROM schools";
        $sql2 = mysqli_query($conn, $sql);

        ?>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>School ID</h5></label>
                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select ID" id="school_id" name="school_id" class="form-control">
                    <option value="">Select School ID</option>
                    <?php
                    if (mysqli_num_rows($sql2) > 0) {
                        foreach ($sql2 as $row) {
                            ?>
                            <option value="<?= $row['school_id'] ?>"><?= $row['school_id'] ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>School Name</h5></label>
                <input class="form-control form-control-solid" size="5" type="text" class="form-control" name="school_name" id="school_name" readonly>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>School Address</h5></label>
                <input class="form-control form-control-solid" size="5" type="text" class="form-control" name="school_address">
            </div>
            <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>District</h5></label>
                <input class="form-control form-control-solid" size="5" type="text" class="form-control" name="district" id="district" readonly>
            </div>
        </div>
        <div class="row mb-4">
        <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>Email Address:</h5></label>
                <input class="form-control form-control-solid" size="5" type="text" class="form-control" name="email_address">
            </div>
            <div class="col-md-6">
                <label class="fw-bold text-muted"><h5>School Size</h5></label>
                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Category" name="category" class="form-control">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    <option value="very_large">Very Large</option>
                </select>
            </div>
            <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px;">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Success</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <!-- Toast message content goes here -->
        </div>
    </div>
</div>

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" name="save_changes">Save changes</button>
</div>
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
<?php
include('admin/includes/script.php');
?>
<script>
    $(document).ready(function() {
    $('#school_id').change(function() {
        var selectedValue = $('#school_id').val(); // Use the correct way to get the selected value

        $.ajax({
            type: 'post',
            url: 'searchid.php',
            dataType: 'JSON',
            data: {
                'school_id': selectedValue
            },
            success: function(data) {
                if (data) {
                    // Update both school_name and district fields
                    $('#school_name').val(data.name);
                    $('#district').val(data.district);
                } else {
                    // Handle case when data is not found
                    $('#school_name').val('');
                    $('#district').val('');
                }
            }
        });
    });
});

</script>
<script>
    // Check if a success message is set in session
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
    ?>
        // Display the toast message using Bootstrap's toast component
        $('.toast').toast({
            delay: 3000 // Auto close after 3 seconds (adjust as needed)
        });
        $('.toast-body').text("<?php echo $_SESSION['success_message']; ?>");
        $('.toast').toast('show');

        // Clear the session variable to prevent the message from appearing on refresh
        <?php unset($_SESSION['success_message']); ?>
    <?php } ?>
</script>
