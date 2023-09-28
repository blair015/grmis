

<?php
include ("admin/includes/header.php");
include ("admin/includes/navbar.php");
include ("admin/includes/sidebar.php");

//if(isset($_POST['btn_login'])){
    if(!isset($_POST['userID']) || !isset($_POST['user_name']) || !isset($_POST['user_role']) || !isset($_POST['user_security']))
    { echo "User ID has NO DATA = "; header("Location: http://202.137.126.58/"); exit(0); }{
        echo $_POST['userID'];
    }
//}

//        $userID = $_POST['userID'];    // id sa user sa masterlist... auto inc
 //       $user_name = $_POST['user_name'];  //email
 //       $user_role = $_POST['user_role']; // teacher, admin... etc..
 //       $user_security = $_POST['user_security'];

        echo $userID;
        echo $user_name;
        echo $user_role;
        echo $user_security;


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
            <?php
include 'admin/config/dbcon3.php'; // Include your database connection file

// SQL query to count the number of rows in the "school_profile" table
$sql = "SELECT COUNT(*) as total_rows FROM tblstudentenrollment";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $totalRows1 = $row['total_rows'];
} else {
    // Handle the query error if needed
    $totalRows1 = 0;
}
?>
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo $totalRows1 ?></h3>

                <p>Student</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          <!-- ./col -->

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

// Calculate the total number of male and female teachers
$totalMaleTeachers = 0;
$totalFemaleTeachers = 0;

foreach ($teacherData as $data) {
  $totalMaleTeachers += $data['male_teachers'];
  $totalFemaleTeachers += $data['female_teachers'];
}

// Calculate the overall total of teachers (male + female)
$totals = $totalMaleTeachers + $totalFemaleTeachers;

?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $totals; ?></h3>
               
                <p>Teaching Personel</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">  <i ></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>1</h3>

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
                            <h3 class="card-title">Total Number of Enrollees</h3>
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
                        include('admin/config/dbcon.php');

                        $sql = "SELECT 
                                  SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS total_male_enrollees,
                                  SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS total_female_enrollees
                                FROM school_enrol";

                        $result = $conn->query($sql);

                        $totalMaleEnrollees = 0;
                        $totalFemaleEnrollees = 0;

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalMaleEnrollees = $row['total_male_enrollees'];
                            $totalFemaleEnrollees = $row['total_female_enrollees'];
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
var totalMaleEnrollees = <?php echo $totalMaleEnrollees; ?>;
var totalFemaleEnrollees = <?php echo $totalFemaleEnrollees; ?>;

// Chart.js configuration for the pie chart
var ctx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Male Enrollees', 'Female Enrollees'],
        datasets: [{
            data: [totalMaleEnrollees, totalFemaleEnrollees],
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