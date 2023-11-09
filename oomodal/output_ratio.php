<!-- Modal for "Output Indicators" -->
<div class="modal fade" id="outputIndicatorsModal" tabindex="-1" role="dialog" aria-labelledby="outputIndicatorsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: orange; color: white;">
                <!-- Add your icon here, for example, a checkmark icon (you can replace it with your desired icon) -->
                <i class="fas fa-check-circle fa-2x"></i>
                <h5 class="modal-title" id="outputIndicatorsModalLabel">Output Indicators Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="outputForm" method="post" action="oomodal/save_ratio_output.php">
                    <?php
                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    include ('admin/config/dbcon.php');
                    $school_id = $_SESSION['school_id'];
                    echo $school_id;
                    ?>
                    <input type="hidden" id="schoolId" name="schoolId" value="<?php echo $school_id; ?>">
                    <div class="form-group">
                        <label for="researchCompleted">New classrooms constructed</label>
                        <input type="text" id="classroomConstructed" name="classroomConstructed" class="form-control" placeholder="Enter the number of new classrooms constructed">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">New classrooms on-going construction</label>
                        <input type="text" id="ongoingConstruction" name="ongoingConstruction" class="form-control" placeholder="Enter the number of classrooms on-going construction">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Textbooks and IMs/LMs procured for printing and delivery</label>
                        <input type="text" id="textbooks" name="textbooks" class="form-control" placeholder="Enter the number here">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Science & Match Package/Items</label>
                        <input type="text" id="scimath" name="scimath" class="form-control" placeholder="Enter the number of package received here">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">ICT Package</label>
                        <input type="text" id="ictPackage" name="ictPackage" class="form-control" placeholder="Enter the number of package received here">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Technical and Vocational Package/Items</label>
                        <input type="text" id="tvPackage" name="tvPackage" class="form-control" placeholder="Enter the number of package received here">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Number of newly-created teaching positions filled-up</label>
                        <input type="text" id="newlyCreated" name="newlyCreated" class="form-control" placeholder="Enter the number of newly-created teaching positions">
                    </div>
                    <div class="form-group">
                        <label>Quarters</label>
                        <div class="row">
                            <div class="col">
                                <label for="quarter1">Q1</label>
                                <input type="radio" id="quarter1" name="quarter" value="1">
                            </div>
                            <div class="col">
                                <label for="quarter2">Q2</label>
                                <input type="radio" id="quarter2" name="quarter" value="2">
                            </div>
                            <div class="col">
                                <label for ="quarter3">Q3</label>
                                <input type="radio" id="quarter3" name="quarter" value="3">
                            </div>
                            <div class="col">
                                <label for="quarter4">Q4</label>
                                <input type="radio" id="quarter4" name="quarter" value="4">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="schoolYear">School Year</label>
                        <select id="schoolYear" name="schoolYear" class="form-control">
                            <?php
                            // Generate options for school years from 2023-2024 to 2030
                            for ($year = 2023; $year <= 2050; $year++) {
                                $nextYear = $year + 1;
                                $schoolYear = $year . '-' . $nextYear;
                                echo '<option value="' . $schoolYear . '">' . $schoolYear . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="saveOutput" class="btn btn-primary">Save</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    // When the form is submitted, show the confirmation modal
    $("#outputForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission
        $("#outputIndicatorsModal").modal("show"); // Corrected modal ID
    });

    // When the "Save" button in the modal is clicked, submit the form
    $("#saveOutput").on("click", function() {
        $("#outputForm").off("submit"); // Remove the previous event handler
        $("#outputForm").submit(); // Submit the form
    });

    $("#confirm_overwrite").on("click", function() {
        // Submit the form when "Yes" is clicked
        $("#outputForm").submit();
    });
});
</script>
