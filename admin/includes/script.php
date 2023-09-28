<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/modals/create-app.js"></script>
<script src="assets/js/custom/modals/upgrade-plan.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


<!-- Include Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="css/adminlte.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the school ID from the PHP code (replace 123 with the actual PHP variable)
    var schoolId = <?php echo $school_id; ?>;

    // Function to fetch data from the PHP script with the specified school ID
    function fetchEnrolleeData(school_id) {
        return fetch('code.php?school_id=' + school_id)
            .then(response => response.json())
            .then(data => {
                // Process the data and create the chart
                createEnrolleeBarChart(data);
            })
            .catch(error => {
                console.error('Error fetching enrollee data:', error);
            });
    }

    // Function to create the bar chart with enrollment data
    function createEnrolleeBarChart(data) {
        var ctx = document.getElementById("enrolleeBarChart");
        var enrolleeBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.year),
                datasets: [{
                    label: 'Enrollees',
                    backgroundColor: 'rgba(2, 117, 216, 1)',
                    borderColor: 'rgba(2, 117, 216, 1)',
                    data: data.map(item => item.enrolle_count),
                }],
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }],
                },
            },
        });
    }

    // Call the function to fetch enrollee data for the specific school ID and create the chart
    fetchEnrolleeData(schoolId);
</script>
<!-- <script>
        $(document).ready(function() {
            $("#municipality").change(function() {
                var selectedMunicipality = $(this).val();
                $.ajax({
                    url: "code.php", // PHP script to fetch districts based on municipality
                    type: "GET",
                    data: { municipality: selectedMunicipality },
                    success: function(response) {
                        $("#district").html(response);
                    }
                });
            });
        });
    </script> -->

<script>
    $(document).ready(function () {
        <?php
        // Loop through the fetched data and populate the modals
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "$('#googleMapModal_" . $row['school_id'] . "').modal();\n";
            }
        }
        ?>
    });
</script>


<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->

