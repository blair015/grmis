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


include ("admin/includes/header.php");
include ("admin/includes/navbar.php");
include ("admin/includes/sidebar.php");

?>

                        <div style="margin-top: 10px;"></div>
                        <div class="author-card-cover" style="background-image: url('assets/images/grmis.png'); height: 230px; background-position: center; background-size: contain;"></div>
                        <div style="margin-top: 10px;"></div>
<div>

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php
include 'admin/config/dbcon.php'; // Include your database connection file

// SQL query to count the number of rows in the "school_profile" table
$sql = "SELECT COUNT(*) as total_rows FROM school_profile";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $totalRows = $row['total_rows'];
} else {
    // Handle the query error if needed
    $totalRows = 0;
}

// // Output the total number of rows
// echo "Total rows in school_profile table: " . $totalRows;

// // Close the database connection if necessary
// $conn->close();
?>

            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totalRows; ?></h3>

                <p>School</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">  <i class="fas fa-arrow-circle-right"></i></a> -->
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            
            <div class="small-box bg-success">
              <div class="inner">
              <h3></h3>

                <p>Student</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          

          <?php

include 'admin/config/dbcon2.php';
// Include your database connection code here

// Define the position type you want to count
$positionType = "Teaching";

// Prepare the SQL statement
$sql = "SELECT COUNT(*) FROM employment_record WHERE position_type = ?";

// Initialize a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the position type parameter
    $stmt->bind_param("s", $positionType);

    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($rowCount1);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Output the count
  //  echo "Number of Non_Teaching positions: " . $rowCount;
} else {
    // Handle the error if the statement couldn't be prepared
    echo "Error preparing the statement.";
}

// Close your database connection here
?>


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $rowCount1; ?></h3>
               
                <p>Teaching Personel</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php
          include 'admin/config/dbcon2.php';
// Include your database connection code here

// Define the position type you want to count
$positionType = "Non_Teaching";

// Prepare the SQL statement
$sql = "SELECT COUNT(*) FROM employment_record WHERE position_type = ?";

// Initialize a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the position type parameter
    $stmt->bind_param("s", $positionType);

    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($rowCount);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Output the count
  //  echo "Number of Non_Teaching positions: " . $rowCount;
} else {
    // Handle the error if the statement couldn't be prepared
    echo "Error preparing the statement.";
}

// Close your database connection here
?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $rowCount; ?></h3>

                <p>Non-Teaching Personel</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        </div>
        <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->  
    <!-- ----------------------------------------CHART-------------------------------------- -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Total Number of Enrolled Students</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <?php
                            include('admin/config/dbcon3.php');

                            $sql = "SELECT 
                                        SUM(CASE WHEN d.gender = 'Male' THEN 1 ELSE 0 END) AS male_students,
                                        SUM(CASE WHEN d.gender = 'Female' THEN 1 ELSE 0 END) AS female_students
                                    FROM tblstudentenrollment e
                                    INNER JOIN tblstudents d ON d.id = e.studentID
                                    WHERE e.status = 'Enrolled'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $maleStudentsCount = $row['male_students'];
                                $femaleStudentsCount = $row['female_students'];
                            } else {
                                // No data found, initialize counts to zero or handle the error
                                $maleStudentsCount = 0;
                                $femaleStudentsCount = 0;
                            }
                            ?>


                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                    </div>
                </div>
                <!-- /.col (RIGHT) -->
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Total Number of Male & Female Teachers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
    <?php
    include 'admin/config/dbcon2.php';

    $sql = "SELECT 
            SUM(CASE WHEN pi.sex = 'Male' THEN 1 ELSE 0 END) AS male_teachers,
            SUM(CASE WHEN pi.sex = 'Female' THEN 1 ELSE 0 END) AS female_teachers
            FROM employment_record AS e
            INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
            WHERE e.position_type = 'Teaching'";

    $result = $conn->query($sql);

    $teacherData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teacherData[] = [
                'male_teachers' => $row['male_teachers'],
                'female_teachers' => $row['female_teachers']
            ];
        }
    }
    ?>
                            <div class="card-body">
                                <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    
<?php
include ("admin/includes/script.php");
include ("admin/includes/footer.php");
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Replace this with your PHP fetching code
var maleStudentsCount = <?php echo $maleStudentsCount; ?>;
var femaleStudentsCount = <?php echo $femaleStudentsCount; ?>;

// Chart.js configuration for the pie chart
var ctx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Male Students', 'Female Students'],
        datasets: [{
            data: [maleStudentsCount, femaleStudentsCount],
            backgroundColor: ['rgba(0, 128, 255, 0.6)', 'rgba(255, 0, 0, 0.6)'],
            borderWidth: 0, // Remove the border
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allow the chart to adjust to its container
        plugins: {
            legend: {
                display: true,
                position: 'right', // Display the legend on the right
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.formattedValue;
                        return label + ': ' + value; // Display label and value in the tooltip
                    }
                }
            }
        }
    }
});
</script>


<script>
// Replace this with your PHP fetching code
var totalMaleTeachers = <?php echo $teacherData[0]['male_teachers']; ?>;
var totalFemaleTeachers = <?php echo $teacherData[0]['female_teachers']; ?>;

// Chart.js configuration for the pie chart
var ctx2 = document.getElementById('pieChart2').getContext('2d');
var pieChart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Male Teachers', 'Female Teachers'],
        datasets: [{
            data: [totalMaleTeachers, totalFemaleTeachers],
            backgroundColor: ['rgba(0, 128, 255, 0.6)', 'rgba(255, 0, 0, 0.6)'],
            borderWidth: 0, // Remove the border
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allow the chart to adjust to its container
        plugins: {
            legend: {
                display: true,
                position: 'right', // Display the legend on the right
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.formattedValue;
                        return label + ': ' + value; // Display label and value in the tooltip
                    }
                }
            }
        }
    }
});
</script>