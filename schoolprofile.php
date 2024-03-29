
<style>

body {
    background-image: url('assets/images/Background.png'); /* Replace with your image file path */
    background-size: cover; /* Adjust as needed */
    background-repeat: no-repeat;
}


</style>

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php
include("admin/includes/header.php");
include("admin/includes/navbar.php");
include("admin/includes/sidebar.php");
?>

<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

</div>
<?php ("admin/includes/sidebar2.php"); ?>

<!-- <<h1 class="mt-4">Database of Schools in Divison of Davao del Sur</h1>
<ol class="breadcrumb mb-0">
 <li class="breadcrumb-item active">School Profile</li> 
</ol> -->
<div style="margin-top: 10px;"></div>

<main> <!-- Main content -->


<?php
// Connect to your database (Replace with your database credentials)
include("admin/config/dbcon.php");

// Initialize variables for default values
$school_header = ''; // Initialize these variables
$school_logo = '';
$school_name = '';
$school_address ='';
$school_email_address ='';
$district = '';
$category ='';
$contact_number = '';
$sbm ='';

// Get the school_id dynamically from the URL
if (isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];
    
    // Sanitize and validate the school_id to prevent SQL injection
    $school_id = mysqli_real_escape_string($conn, $school_id);
        

    // Fetch the image URLs from the database based on the dynamic school_id
    $sql = "SELECT school_header, school_logo, school_name, school_address, school_email_address,contact_number, District, category, sbm_level FROM school_profile WHERE school_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $school_id); // "i" represents an integer parameter
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $school_header, $school_logo, $school_name, $school_address, $school_email_address, $contact_number, $district, $category, $sbm); // Fetch the results
        
        if (mysqli_stmt_fetch($stmt)) {
            // Images found in the database
        }
        
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($conn);
?>
<div>
    <div class="author-card pb-2">
        <?php if (!empty($school_header)): ?>
        <div class="author-card-cover" style="background-image: url('<?php echo $school_header; ?>'); height: 250px;"></div>
        <?php endif; ?>
        <div class="author-card-profile">
            <?php if (!empty($school_logo)): ?>
            <div class="author-card-avatar"><img src="<?php echo $school_logo; ?>" alt="<?php echo $school_logo; ?>"
                    style="width: 200px; height: 200px;"></div>
            <?php endif; ?>
            <br></br>
            <h5 class="author-card-name" style="font-size: 50px;"><?php echo $school_name; ?></h5>
            <span class="author-card-position" style="font-size: 20px; "><?php echo $school_address; ?></span><br>
            <span id="editProfileIcon" class="author-card-position" style="font-size: 20px; color: blue; font-style: italic; cursor: pointer;" data-toggle="modal" data-target="#updateProfileModal">
                    <i class="fas fa-edit"></i> Edit Profile 
                </span>
                <script>
$(document).ready(function () {
    // Get the values of user_school_id, school_id, and user_role from PHP
    var userSchoolId = <?php echo json_encode($_GET['user_school_id']); ?>;
    var schoolId = <?php echo json_encode($_GET['school_id']); ?>;
    var userRole = <?php echo json_encode($_SESSION['user_role']); ?>;

    // Check if the school_id is equal to user_school_id
    // and if the user_role is one of the specified roles
    if (schoolId === userSchoolId &&
        (userRole === 'Planning' ||
         userRole === 'SDS' ||
         userRole === 'Admin')) {
        // Show the "Edit Profile" icon
        $("#editProfileIcon").show();
        $("#editButton").show();
        // Show the "Edit" button
         $("#Buttonedit").show();
         // Show the "Download Report" button
         $("#downloadButton").show();
         $(".view-profile-button").show();
         $("#dropdownMenuButton").show();
    } else {
        // Hide the "Edit Profile" icon
        $("#editProfileIcon").hide();
        $("#editButton").hide();
        // Hide the "Edit" button
           $("#Buttonedit").hide();
       // Hide the "Download Report" button
        $("#downloadButton").hide()
        $(".view-profile-button").hide();
        $("#dropdownMenuButton").hide();
    }
});


</script>

        </div>
    </div>
</div>

        <!-- <div class="author-card-details">
          <h5 class="author-card-name" style="font-size: 50px;">Sta. Cruz National High School</h5>
          <span class="author-card-position" style="font-size: 20px; ">Santa Cruz,South, Davao del Sur</span>
        </div> -->
     

  <div style="margin-top: 10px;"></div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
        <style>
   /* Define a custom "orange" class for the card */
.card-orange {
    background-color: #FFA500; /* Replace with your desired shade of orange */
    border-color: #FFA500; /* Set border color to match */
    color: #fff; /* Set text color to white or your desired text color */
}

</style>

          <!-- Profile Image -->
          <div class="card card-orange">
            <div class="card-header">
              <h3 class="card-title">School Profile</h3>
            </div>
            <div class="card-body card-primary">

              <!-- <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nina Mcintire</h3>

                <p class="text-muted text-center">Software Engineer</p> -->
                <?php
                        include 'admin/config/dbcon2.php';

                        $selectedSchoolId = $_GET['school_id'];

                        $sql = "SELECT pi.emp_no, pi.lastname, pi.firstname
                        FROM employment_record AS e
                        INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
                        WHERE e.position_type = 'Teaching_Related' AND e.school_id = ? AND e.position_rank IN ('School Principal I', 'School Principal II', 'School Principal III', 'School Principal IV')";

                         
                        // Query to get the district supervisor's name
                        $sql2 = "SELECT pi.lastname, pi.firstname
                        FROM employment_record AS er
                        INNER JOIN personal_info AS pi ON er.emp_no = pi.emp_no
                        WHERE er.position_rank = 'public school district supervisor'
                        AND er.district = (SELECT district FROM employment_record WHERE school_id = ? LIMIT 1)";


                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $selectedSchoolId);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $school_head_name = ''; // Initialize the variable
                                while ($row = $result->fetch_assoc()) {
                                    $lname = $row['lastname'];
                                    $fname = $row['firstname'];
                                    $school_head_name .= $fname . " " . $lname . ', '; // Append names
                                }
                                // Remove the trailing comma and space
                                $school_head_name = rtrim($school_head_name, ', ');

                                // Now, you can use $school_head_name in your HTML to display the names
                            } else {
                                $school_head_name = "No assigned school head";
                            }
                        }
                        // Execute the query to get the district supervisor's name
                            if ($stmt2 = $conn->prepare($sql2)) {
                                $stmt2->bind_param("i", $selectedSchoolId);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();

                                if ($result2->num_rows > 0) {
                                    $row2 = $result2->fetch_assoc();
                                    $district_supervisor_name = $row2['firstname'] . ' ' . $row2['lastname'];
                                } else {
                                    $district_supervisor_name = "No assigned district supervisor";
                                }
                            }
                        ?>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>School ID:</b> <a class="float-right" style="color: blue;"><?php echo $school_id; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>School Head:</b> <a class="float-right" style="color: blue;"><?php echo $school_head_name; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email Address:</b> <a class="float-right" style="color: blue;"><?php echo $school_email_address; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contact Number:</b> <a class="float-right" style="color: blue;"><?php echo $contact_number; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>District:</b> <a class="float-right" style="color: blue;"><?php echo $district; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Category:</b> <a class="float-right" style="color: blue;"><?php echo $category; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>SBM Level:</b> <a class="float-right" style="color: blue;"><?php echo $sbm; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>District Supervisor:</b> <a class="float-right" style="color: blue;"><?php echo $district_supervisor_name; ?></a>
                                </li>
                            </ul>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- Our  Location Box -->
          <?php
include('admin/config/dbcon.php');

// Get the school_id from the URL parameter
if (isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];

    // Query to fetch location information from the database
    $sql = "SELECT frame FROM location WHERE school_id = $school_id";
    $result = $conn->query($sql);

    // Fetch the location iframe code from the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $locationIframeCode = $row['frame'];
    }
}
?>

<div class="card card-orange">
    <div class="card-header">
        <h3 class="card-title">Our Location</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if (isset($locationIframeCode)) { ?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php echo $locationIframeCode; ?>
            </div>
        <?php } else { ?>
            <p>No location found for this school.</p>
        <?php } ?>
    </div>
    <!-- /.card-body -->
</div>

<style>
    .map-container.enlarged {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .map-container.enlarged iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    
</style>


        </div>
        <div class="col-md-9">
  <div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="#About" data-toggle="tab">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#Teaching" data-toggle="tab">Teaching & Non Teaching</a></li>
        <li class="nav-item"><a class="nav-link" href="#kpi" data-toggle="tab">Key Performance Indicator</a></li>
        <li class="nav-item"><a class="nav-link" href="#pf" data-toggle="tab">Physical Facilities</a></li>
        
        <!-- Dropdown Tab -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#additional-tab1" data-toggle="tab">Additional Tab 1</a>
            <a class="dropdown-item" href="#additional-tab2" data-toggle="tab">Additional Tab 2</a>
            <!-- Add more dropdown items as needed -->
          </div>
        </li>
        <!-- End Dropdown Tab -->
        
      </ul>
    </div><!-- /.card-header -->
    
    <!-- Add tab content for additional tabs as needed -->
    
  </div>

            <div class="card-body">
              <div class="tab-content">


                <!-- --------------ABOUT THE SCHOOL TAB-------------------- -->
    
                <div class="active tab-pane" id="About">
    <style>
        .history-content {
            text-align: justify;
        }

        .history-content p {
            text-indent: 1em;
        }
    </style>
    <?php
        include('admin/config/dbcon.php');


    ?>
    <div style="position: relative;">
        <!-- Your content here -->
        <div class="history-content">
            <p><strong>History of the school:</strong> <span id="schoolHistoryText">This is the current content that can be edited.</span></p>
            <p>This is the second paragraph in the school's history.</p>
        </div>

        <!-- Edit button that triggers the modal -->
        <button id="editButton" style="position: absolute; top: 0; right: 0;" data-toggle="modal" data-target="#aboutModal">
            <i class="fas fa-edit" style="margin-right: 5px;"></i>Edit
        </button>
    </div>
</div>

<!-- The Modal -->
<input type="hidden" id="schoolId2" value="<?php echo $selectedSchoolId; ?>">

<div class="modal" id="aboutModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit History of the School</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <textarea id="schoolHistory" rows="5" class="form-control"
                          placeholder="Enter the updated history of the school"></textarea>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveHistory()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveHistory() {
        // Get the updated history from the textarea
        var newHistory = document.getElementById("schoolHistory").value;
        var schoolId = document.getElementById("schoolId2").value;

        // Send the data to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_history.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'success') {
                    // Update the displayed history on success
                    document.getElementById("schoolHistoryText").innerText = newHistory;
                } else {
                    alert("Error: " + response);
                }
            }
        };
        xhr.send("newHistory=" + newHistory + "&schoolId=" + schoolId);
    }
</script>


                <!-- ------------------------TEACHING AND NON TEACHING TAB---------- -->
                <div class="tab-pane" id="Teaching">
                <div class="row g-2 mb-2">
                      <div class="col-md-6 fv-row">
                      <div class="card card-orange">
                          <div class="card-header">
                              <h3 class="card-title">Teacher Profile</h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                                      <i class="fas fa-times"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="chart">
                                  <canvas id="TeachingBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
        
                    <div class="col-md-6 fv-row">
                      <div class="card card-orange">
                          <div class="card-header">
                              <h3 class="card-title">Non-Teaching Profile</h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                                      <i class="fas fa-times"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="chart">
                                  <canvas id="Non_TeachingBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
            </div>
            <?php
            include 'admin/config/dbcon2.php';

            $selectedSchoolId = $_GET['school_id'];
            
            $sql = "SELECT e.yrs_in_serv, e.position_type, e.item_no, pi.emp_no, pi.lastname, pi.firstname, pi.middlename, e.position_rank, pp.image, pi.dob, pi.pob, pi.sex, pi.civilstatus, pi.mobile, pi.email
                    FROM employment_record AS e
                    INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
                    INNER JOIN profile_pic AS pp ON pi.emp_no = pp.emp_no
                    WHERE e.school_id = ?
                    ORDER BY pi.lastname ASC";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $selectedSchoolId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    ?>

    <div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
        while ($row = $result->fetch_assoc()) {
            $lname = $row['lastname'];
            $fname = $row['firstname'];
            $emp_no = $row['emp_no'];
            $image = $row['image'];
            $yrs_in_serv = $row['yrs_in_serv'];
            $position_type = $row['position_type'];
            $item_no = $row['item_no'];
            $dob = $row['dob'];
            $pob = $row ['pob'];
            $sex = $row['sex'];
            $civilstatus = $row['civilstatus'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $imageUrl = "../heroes/admin/$image";
    ?>
                <div class="col">
                <div class="card border-primary shadow position-relative" style="background-color: #f5f5f5; border: 1px solid #ccc;">
                <div class="card-body text-center">
                    <img src="<?php echo $imageUrl; ?>" alt="Teacher's Picture" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                    <b><h6 class="my-1"><?php echo $row['lastname'] . ', ' . $row['firstname']; ?></h6></b>
                    <p class="text-muted mb-2"><?php echo $row['position_rank']; ?></p>
                </div>
                <div class="position-absolute bottom-0 end-0">
                    <button class="btn btn-success view-profile view-profile-button" data-teacher-id="<?php echo $emp_no; ?>">View</button>
                </div>
            </div>
        </div>

        <?php
                }
                ?>
            </div>
        </div>

        <?php
    } else {
        echo "No teachers found for the selected school.";
    }

    $stmt->close();
} else {
    echo "Error in preparing the SQL statement.";
}
?>
<!-- Teacher Profile Modal -->
<div class="modal" id="teacherProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header" style="background-color: green; color: white;">
            <i class="fas fa-user-circle fa-2x"></i>
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content for the teacher profile goes here -->
            </div>
        </div>
    </div>
</div>
    </div>
  
                <!-- ------------------KEY PERFORMANCE INDICATOR TAB---------------- -->
                <div class="tab-pane" id="kpi">
                    <div class="row g-2 mb-2">
                        <div class="col-md-6 fv-row">
                            <div class="card card-orange">
                          <div class="card-header">
                              <h3 class="card-title">Enrollment Per Year By Sex</h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                                      <i class="fas fa-times"></i>
                                  </button>
                                 </div>
                                 </div>
                                <div class="card-body">
                              <div class="chart">
                                  <canvas id="enrolleeBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>  

                  <div class="col-md-6 fv-row">
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title">Students Enrollment by Year</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <!-- Use $teacherData to populate your chart -->
                    <canvas id="enrolleeBarChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
</div>
                <!-- ------------------PHYSICAL FACILITIES TAB---------------- -->
<div class="tab-pane" id="pf">
<?php


include ("addpf.php");

$selectedSchoolId2 = $_GET['school_id'];


?>
                <style>
    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu > li:hover > .dropdown-submenu {
        display: block;
    }
</style>

<?php
include ('oomodal/research.php');
include ('oomodal/outcome_ratio.php');
include ('oomodal/output_ratio.php');
include ('oomodal/inclusive.php');
include ('oomodal/hrm.php');
include ('oomodal/retention.php');


?>
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" name ="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
        Organizational Outcome
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a class="dropdown-item" href="#">
                Education Policy Development Program &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
                <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#researchCompletedModal">Research Completed</a>
                </li>
           </ul>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                Basic Education Inputs Program &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
                                <li>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#outcomeIndicatorsModal">Outcome Indicators</a>
                    </li>
                        <li>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#outputIndicatorsModal">Output Indicators</a>
                    </li>
            </ul>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                Inclusive Education Program &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
                <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#inclusiveEducationModal">Add Data</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                Support to Schools and Learners Program &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
                <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#retentionEducationModal">Add Data</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Output Indicators</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                Education Human Resource Development Program &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
                <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hrmModal">Add Data</a>
                </li>
            </ul>
        </li>
       <li>
       <a class="dropdown-item" href="oomodal/oo_report.php?school_id=<?php echo $_SESSION['school_id']; ?>" target="_blank">
    Download Organization Outcome Report
</a>

</li>

    </ul>
</div>

               

    <button type="button" class="btn btn-success" id="Buttonedit" data-toggle="modal" data-target="#editModal">
    <i class="fas fa-edit"></i> Add / Edit
</button>
<br></br>
<form action="generate_report.php?school_id=<?php echo $selectedSchoolId2; ?>" method="post" target="_blank">
<button type="submit" class="download-button" id="downloadButton" style="background-color: blue; color: white;">
    <i class="fas fa-file-download"></i> Download Report
</button>
</form>
<?php
    include 'admin/config/dbcon.php';

    $selectedSchoolId2 = $_GET['school_id'];

    $sql = "SELECT academic_classroom, non_academic_classroom, needing_repair, tls, makeshift, arms_and_chairs, tables_and_chairs, functional_clinic
            FROM school_profile AS sp
            WHERE sp.school_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $selectedSchoolId2);
        $stmt->execute();
        $stmt->bind_result($academic_classroom, $non_academic_classroom, $needing_repair, $tls, $makeshift, $arms_and_chairs, $tables_and_chairs, $functional_clinic);
        
        if ($stmt->fetch()) {
            // Display the fetched data in your HTML
           // echo '<h3>Physical Facilities</h3>';
            //echo '<p>Academic Classrooms: ' . $academic_classroom . '</p>';
            //echo '<p>Non-Academic Classrooms: ' . $non_academic_classroom . '</p>';
            //echo '<p>Needing Repair: ' . $needing_repair . '</p>';
            //echo '<p>TLS (Teacher Learning Materials): ' . $tls . '</p>';
            //echo '<p>Makeshift Facilities: ' . $makeshift . '</p>';
            //echo '<p>Arms and Chairs: ' . $arms_and_chairs . '</p>';
            //echo '<p>Tables and Chairs: ' . $tables_and_chairs . '</p>';
            //echo '<p>Functional Clinic: ' . $functional_clinic . '</p>';
        
    ?>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-info"><i class="fas fa-school"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Academic Classroom</span>
                            <span class="info-box-number"><strong><?php echo $academic_classroom; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-info"><i class="fas fa-school"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Non - Academic Classroom</span>
                            <span class="info-box-number"><strong><?php echo $non_academic_classroom; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info bg-danger"><i class="fas fa-hammer"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Needing Repair</span>
                            <span class="info-box-number"><strong><?php echo $needing_repair; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                     <span class="info-box-icon bg-info"><i class="fas fa-home"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Temporary Learning Shelter</span>
                            <span class="info-box-number"><strong><?php echo $tls; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <div class="row">
            <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                     <span class="info-box-icon bg-info"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Make Shift</span>
                            <span class="info-box-number"><strong><?php echo $makeshift; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                     <span class="info-box-icon bg-info bg-dark"><i class="fas fa-chair"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number of Arm Chairs</span>
                            <span class="info-box-number"><strong><?php echo $arms_and_chairs; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info bg-dark"><i class="fas fa-table"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number of Tables and Chairs</span>
                            <span class="info-box-number"><strong><?php echo $tables_and_chairs; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="info-box">
                     <span class="info-box-icon bg-info bg-light"><i class="fas fa-hospital"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number of Functional Clinic</span>
                            <span class="info-box-number"><strong><?php echo $functional_clinic; ?></strong></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                
         </div>
<?php
} else {
    echo 'No data found for the selected school.';
}

$stmt->close();
} else {
echo 'Error in preparing the SQL statement.';
}

?>
<!-- Closing </div> for <div class="tab-content"> -->
                   <!-- ADDITIONAL TAB 1 -->
<div class="tab-pane" id="additional-tab1">
    <!-- Content for Additional Tab 1 -->
    <div id="additional-tab1-content">
        <!-- Content for Additional Tab 1 will be loaded dynamically here -->
    </div>
</div>

       <!-- ADDITIONAL TAB 2 -->
<div class="tab-pane" id="additional-tab2">
    <!-- Content for Additional Tab 2 -->
    <div id="additional-tab2-content">
        <!-- Content for Additional Tab 2 will be loaded dynamically here -->
    </div>
</div>
        
</div>
                
              <!-- /.tab-pane -->
              </div>
              
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </section>
     </div>
            
            <!-- /.card-body -->
        </div>
        
        <!-- /.card -->
    </div>
    </div>
 
  
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
            
       
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                    <i class="fas fa-school" style="color: blue; margin-right: 10px;"></i> <!-- School icon -->
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body p-9">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>School ID</h5></label>
                                <input class="form-control form-control-solid" type="text" name="school_id" id="id" value="<?php echo $school_id; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>School Name</h5></label>
                                <input class="form-control form-control-solid" type="text" name="school_name" value="<?php echo $school_name;?>" id="school_name">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>School Address</h5></label>
                                <input class="form-control form-control-solid" type="text" name="school_address" value="<?php echo $school_address; ?>" id="schoo_address">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>District</h5></label>
                                <input class="form-control form-control-solid" type="text" name="district" id="district" value="<?php echo $district; ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Email Address:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="school_email" id="school_email" value="<?php echo $school_email_address; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>School Size</h5></label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Category" name="category">
                                    <option value="Small">Small</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Large">Large</option>
                                    <option value="Very Large">Very Large</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Contact Number:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="contact_number" id="contact_number" value="<?php echo $contact_number; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>SBM Level</h5></label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Category" name="sbm_level">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Upload School Logo</h5></label>
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url(assets/media/avatars/deped.png)"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="school_logo" accept=".png, .jpg, .jpeg" value=""/>
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Upload School Header</h5></label>
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                                    <div class="image-input-wrapper w-550px h-200px" style="background-image: url(assets/media/avatars/header.jpg)"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="school_header" accept=".png, .jpg, .jpeg" value=""/>
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="save_changes">Save changes</button>
                        </div>
            </form>

  <!-- javascript for editaboutmodal -->
  <script>
document.getElementById('editButton').addEventListener('click', function() {
  // Make an AJAX request to fetch the modal content from home.php
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Inject the modal content into a hidden element
      var modalContainer = document.getElementById('modalContainer');
      modalContainer.innerHTML = xhr.responseText;

      // Show the modal
      $('#editaboutModal').modal('show');
    }
  };
  xhr.open('GET', 'home1.php', true);
  xhr.send();
});
</script>





  <?php
  include("admin/includes/script.php");
  include("admin/includes/footer.php");
  ?>
  
  <?php
include 'admin/config/dbcon2.php';

$selectedSchoolId = $_GET['school_id']; // You should sanitize and validate this input

$sql = "SELECT e.school_id, 
               SUM(CASE WHEN pi.sex = 'Male' THEN 1 ELSE 0 END) AS male_teachers,
               SUM(CASE WHEN pi.sex = 'Female' THEN 1 ELSE 0 END) AS female_teachers
        FROM employment_record AS e
        INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
        WHERE e.school_id = $selectedSchoolId 
        AND e.position_type = 'Teaching'
        GROUP BY e.school_id";

$result = $conn->query($sql);

$teacherData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teacherData[] = [
            'school_id' => $row['school_id'],
            'male_teachers' => $row['male_teachers'],
            'female_teachers' => $row['female_teachers']
        ];
    }
}
?>



<!-- Teaching Bar Chart -->
<script>
// Replace this with your database fetching code or API call
var teacherData = <?php echo json_encode($teacherData); ?>;

// Extract ids and male/female teachers for the chart
var ids = teacherData.map(function(data) {
    return data.school_id; // Changed from 'year' to 'id'
});
var maleTeachers = teacherData.map(function(data) {
    return data.male_teachers;
});
var femaleTeachers = teacherData.map(function(data) {
    return data.female_teachers;
});

// Chart.js configuration
var ctx = document.getElementById('TeachingBarChart').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ids, // Changed from 'years' to 'ids'
        datasets: [
            {
                label: 'Male Teachers',
                data: maleTeachers,
                backgroundColor: 'rgba(0, 128, 255, 0.6)'
            },
            {
                label: 'Female Teachers',
                data: femaleTeachers,
                backgroundColor: 'rgba(255, 0, 0, 0.6)'
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<!-- Non Teaching -->
<?php
$selectedSchoolId1 = $_GET['school_id']; // You should sanitize and validate this input

$sql = "SELECT e.school_id, 
               SUM(CASE WHEN pi.sex = 'Male' THEN 1 ELSE 0 END) AS male_non_teaching,
               SUM(CASE WHEN pi.sex = 'Female' THEN 1 ELSE 0 END) AS female_non_teaching
        FROM employment_record AS e
        INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
        WHERE e.school_id = $selectedSchoolId1 
        AND e.position_type = 'Non_Teaching'
        GROUP BY e.school_id";

$result = $conn->query($sql);

$teacherData1 = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teacherData1[] = [
            'school_id' => $row['school_id'],
            'male_non_teaching' => $row['male_non_teaching'],
            'female_non_teaching' => $row['female_non_teaching']
        ];
    }
}
?>

<!-- Non Teaching Bar Chart -->
<script>
// Replace this with your database fetching code or API call
var teacherData1 = <?php echo json_encode($teacherData1); ?>;

// Extract school_ids and male/female non-teaching staff for the chart
var schoolIds = teacherData1.map(function(data) {
    return data.school_id;
});
var maleNonTeaching = teacherData1.map(function(data) {
    return data.male_non_teaching;
});
var femaleNonTeaching = teacherData1.map(function(data) {
    return data.female_non_teaching;
});

// Chart.js configuration for the Non-Teaching bar chart
var ctxNonTeaching = document.getElementById('Non_TeachingBarChart').getContext('2d');
var barChartNonTeaching = new Chart(ctxNonTeaching, {
    type: 'bar',
    data: {
        labels: schoolIds,
        datasets: [
            {
                label: 'Male Non-Teaching',
                data: maleNonTeaching,
                backgroundColor: 'rgba(0, 128, 255, 0.6)'
            },
            {
                label: 'Female Non-Teaching',
                data: femaleNonTeaching,
                backgroundColor: 'rgba(255, 0, 0, 0.6)'
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>




<!-- Enrolled students by Sex -->
<?php
include('admin/config/dbcon3.php');

$selectedSchoolId = $_GET['school_id']; // You should sanitize and validate this input

$sql = "SELECT 
            SUM(CASE WHEN d.gender = 'Male' THEN 1 ELSE 0 END) AS male_students,
            SUM(CASE WHEN d.gender = 'Female' THEN 1 ELSE 0 END) AS female_students
         FROM tblstudentenrollment e
         INNER JOIN tblschool s ON s.id = e.s_id
         INNER JOIN tblstudents d ON d.id = e.studentID
         WHERE e.sy = '2022-2023'
         AND s.schoolID = '$selectedSchoolId'
         AND e.status = 'Enrolled'";

$result = $conn->query($sql);

$enrollData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $enrollData[] = [
            'male_students' => $row['male_students'],
            'female_students' => $row['female_students']
        ];
    }
}
?>

<!-- Include your HTML and other code here -->

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Replace this with your database fetching code or API call
var enrollData = <?php echo json_encode($enrollData); ?>;

// Extract male/female students for the chart
var maleStudents = enrollData.map(function(data) {
    return data.male_students;
});
var femaleStudents = enrollData.map(function(data) {
    return data.female_students;
});

// Chart.js configuration
var ctx = document.getElementById('enrolleeBarChart').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Male Students', 'Female Students'],
        datasets: [
            {
                label: 'Number of Students',
                data: [maleStudents[0], femaleStudents[0]],
                backgroundColor: ['rgba(0, 128, 255, 0.6)', 'rgba(255, 0, 0, 0.6)']
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>



<?php
include('admin/config/dbcon3.php');

$selectedSchoolId = $_GET['school_id']; // You should sanitize and validate this input

$sql = "SELECT s.sy AS year, s.gradelvl AS grade_level, COUNT(*) AS total_enrollees
        FROM tblsection s
        WHERE s.schoolID = '$selectedSchoolId'
        GROUP BY s.sy, s.gradelvl";

$result = $conn->query($sql);

$enrollDataByGrade = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $enrollDataByGrade[] = [
            'year' => $row['year'],
            'grade_level' => $row['grade_level'],
            'total_enrollees' => $row['total_enrollees']
        ];
    }
}
?>


<!-- Include your HTML and other code here -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Replace this with your database fetching code or API call
var enrollDataByGrade = <?php echo json_encode($enrollDataByGrade); ?>;

// Extract years, grade levels, and total enrollees for the chart
var yearsByGrade = enrollDataByGrade.map(function(data) {
    return data.year;
});
var gradeLevels = [...new Set(enrollDataByGrade.map(data => data.grade_level))]; // Get unique grade levels
var totalEnrolleesByGrade = gradeLevels.map(function(grade) {
    return {
        label: grade,
        data: enrollDataByGrade.filter(data => data.grade_level === grade).map(data => data.total_enrollees),
        backgroundColor: getRandomColors(enrollDataByGrade.length), // Generate random colors
    };
});

// Function to generate random colors
function getRandomColors(count) {
    var colors = [];
    for (var i = 0; i < count; i++) {
        colors.push(getRandomColor());
    }
    return colors;
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Chart.js configuration for the bar chart
var ctx = document.getElementById('enrolleeBarChart2').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: yearsByGrade,
        datasets: totalEnrolleesByGrade
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top'
            }
        },
        datasets: {
            bar: {
                barPercentage: 0.9, // Adjust this value to change bar width (0.9 = 90% of the available space)
                categoryPercentage: 0.8, // Adjust this value to change the space between bars
            }
        }
    }
});
</script>


<script>
    $(document).ready(function() {
        // Handle the "View" button click event
        $(".view-profile").click(function() {
            // Get the teacher ID associated with the clicked button
            var teacherId = $(this).data("teacher-id");

            // Make an AJAX request to fetch the teacher's information
            $.ajax({
                type: "GET",
                url: "fetch_teacher_info.php", // Create this PHP file to fetch teacher info
                data: { emp_no: teacherId },
                success: function(data) {
                    // Update the modal content with the fetched teacher information
                    $(".modal-body").html(data);
                    $("#teacherProfileModal").modal("show");
                }
            });
        });
    });
</script>
<script>
$(document).ready(function() {
    // Handle the click event for Additional Tab 1
    $('a[href="#additional-tab1"]').on('click', function (e) {
        e.preventDefault();
        // Load content dynamically for Additional Tab 1 using AJAX
        $.ajax({
            url: 'memotab.php', // Update with the actual path
            type: 'GET',
            success: function(response) {
                $('#additional-tab1-content').html(response);
                $('a[href="#additional-tab1"]').tab('show');
            },
            error: function(error) {
                console.error('Error loading content for Additional Tab 1:', error);
            }
        });
    });

    // Handle the click event for Additional Tab 2
    $('a[href="#additional-tab2"]').on('click', function (e) {
        e.preventDefault();
        // Load content dynamically for Additional Tab 2 using AJAX
        $.ajax({
            url: 'path/to/content2.php', // Update with the actual path
            type: 'GET',
            success: function(response) {
                $('#additional-tab2-content').html(response);
                $('a[href="#additional-tab2"]').tab('show');
            },
            error: function(error) {
                console.error('Error loading content for Additional Tab 2:', error);
            }
        });
    });
});

</script>