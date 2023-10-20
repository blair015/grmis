
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

// Get the school_id dynamically from the URL
if (isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];
    
    // Sanitize and validate the school_id to prevent SQL injection
    $school_id = mysqli_real_escape_string($conn, $school_id);
    
    // Fetch the image URLs from the database based on the dynamic school_id
    $sql = "SELECT school_header, school_logo, school_name, school_address, school_email_address, District, category FROM school_profile WHERE school_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $school_id); // "i" represents an integer parameter
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $school_header, $school_logo, $school_name, $school_address, $school_email_address, $district, $category); // Fetch the results
        
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
    } else {
        // Hide the "Edit Profile" icon
        $("#editProfileIcon").hide();
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

          <!-- Profile Image -->
          <div class="card card-primary">
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

                    $sql = "SELECT pi.emp_no, pi.lastname, pi.firstname, pi.middlename, e.position_rank
                        FROM employment_record AS e
                        INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
                        WHERE e.position_rank = 'Teaching_Related'";


                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                           
                        while ($row = $result->fetch_assoc()) {
                            
                            
                            $lname = $row['lastname'];
                            $fname = $row['firstname'];
                            $school_head_name = $fname." ".$lname;
                        }
                        

                        
                    
                            ?>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>School ID:</b> <a class="float-right"><?php echo $school_id; ?></a>
                </li>
                <li class="list-group-item">
                  <b>School Head:</b> <a class="float-right"><?php echo $school_head_name; ?></a>
                </li>
                        <?php
                        }
                    }
                        ?>
                <li class="list-group-item">
                  <b>Email Address:</b> <a class="float-right"><?php echo $school_email_address; ?></a>
                </li>

                <li class="list-group-item">
                  <b>District</b> <a class="float-right"><?php echo $district; ?></a>
                </li>

                <li class="list-group-item">
                  <b>Category</b> <a class="float-right"><?php echo $category; ?></a>
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

<div class="card card-primary">
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
              </ul>
            </div><!-- /.card-header -->
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
    <div style="position: relative;">
        <!-- Your content here -->
        <div class="history-content">
            <p><strong>History of the school:</strong> This is the current content that can be edited.</p>
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
                <h4 class a="modal-title">Edit History of the School</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <textarea id="schoolHistory" rows="5" class="form-control" placeholder="Enter the updated history of the school"></textarea>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateHistory()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update the history
    function updateHistory() {
        var newHistory = document.getElementById("schoolHistory").value;
        var schoolId2 = document.getElementById("schoolId2").value;
        
        // Send the updated history to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'update_history.php', // Create this PHP file to handle the update
            data: { schoolId: schoolId2, newHistory: newHistory },
            success: function(response) {
                if (response === 'success') {
                    // Update the content on the page with the new history
                    document.querySelector(".active#About .history-content").innerHTML = newHistory;
                } else {
                    // Handle error
                    alert("Failed to update history. Please try again.");
                }
            }
        });
    }
</script>


                <!-- ------------------------TEACHING AND NON TEACHING TAB---------- -->
                <div class="tab-pane" id="Teaching">
                <div class="row g-2 mb-2">
                      <div class="col-md-6 fv-row">
                      <div class="card card-success">
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
                      <div class="card card-success">
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
            
            $sql = "SELECT pi.emp_no, pi.lastname, pi.firstname, pi.middlename, e.position_rank, pp.image
                    FROM employment_record AS e
                    INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
                    INNER JOIN profile_pic AS pp ON pi.emp_no = pp.emp_no
                    WHERE e.school_id = ?";

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
                    
                    
                    $lname=$row['lastname'];
                    $fname=$row['firstname'];
                    $emp_no = $row['emp_no'];
                    $image = $row['image'];
                    //$imageFolder = $image;
                   // $teacherId = $lname."_".$fname."_".$emp_no;
                  //  $imageFileName = $teacherId . '.jpg';
                    $imageUrl = "../heroes/admin/$image";
                    ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="<?php echo $imageUrl; ?>" alt="Teacher's Picture"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <h6 class="my-3"><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></h6>
                        <p class="text-muted mb-1"><?php echo $row['position_rank']; ?></p>
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
    </div>
  
                <!-- ------------------KEY PERFORMANCE INDICATOR TAB---------------- -->
                <div class="tab-pane" id="kpi">
                <div class="row g-2 mb-2">
                      <div class="col-md-6 fv-row">
                      <div class="card card-success">
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
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>  

                  <div class="col-md-6 fv-row">
        <div class="card card-success">
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
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="very_large">Very Large</option>
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
