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

                      <h1 class="mt-4">Schools for Approval</h1>
                        
<div>
            
    <main>
        <div class="container-fluid px-4">
        				<div class="card mb-4">
                               <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>School ID</th>
                                            <th>Name of School</th>
                                            <th>Address</th>
                                            <th>District</th>
                                            <th>School Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>School ID</th>
                                            <th>Name of School</th>
                                            <th>Address</th>
                                            <th>District</th>
                                            <th>School Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                            include("admin/config/dbcon.php");

                                            $query = "SELECT * FROM approval";
                                            $result = $conn->query($query);

                                            // Loop through the fetched data and populate the table rows
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['school_id'] . "</td>";
                                                    echo "<td>" . $row['school_name'] . "</td>";
                                                    echo "<td>" . $row['school_address'] . "</td>";
                                                    echo "<td>" . $row['district'] . "</td>";
                                                    echo "<td>" . $row['category'] . "</td>";
                                                    echo "<td>
                                                    <a href='approval.php?school_id=" . $row['school_id'] . "&school_name=" . $row['school_name'] . "&school_address=" . $row['school_address'] . "&district=" . $row['district'] . "&category=" . $row['category'] . "'>
                                                    <i class=\"fas fa-check-circle fa-2x\" style=\"color: green;\"></i>
                                                </a>
                                                        <a href='delete_school.php?school_id=" . $row['school_id'] . "'>
                                                            <i class=\"fas fa-trash fa-2x\" style=\"color: red;\"></i>
                                                        </a>
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
        var confirmApproval = confirm('Do you want to approve this school?');
        if (confirmApproval) {
            var schoolId = "<?php echo $_GET['school_id']; ?>";
            var schoolName = "<?php echo $_GET['school_name']; ?>";
            var schoolAddress = "<?php echo $_GET['school_address']; ?>";
            var district = "<?php echo $_GET['district']; ?>";
            var category = "<?php echo $_GET['category']; ?>";
            window.location.href = 'approve_school.php?school_id=' + schoolId + '&school_name=' + schoolName + '&school_address=' + schoolAddress + '&district=' + district + '&category=' + category;
        } else {
            window.location.href = 'approval.php'; // Redirect back to the previous page on cancel
        }
    </script>