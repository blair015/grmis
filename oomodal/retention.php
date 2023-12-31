<!-- Modal structure -->
<div class="modal" id="retentionEducationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Retention Rate Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="retentionForm" method="post" action="oomodal/save_retention.php">
                    <?php
                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    include('admin/config/dbcon.php');
                    $school_id = $_SESSION['school_id'];
                    echo $school_id;
                    ?>
                    <input type="hidden" id="schoolId" name="schoolId" value="<?php echo $school_id; ?>">
                    <div class="form-group">
                        <label>Are You offering?</label>
                        <div class="row">
                            <div class="col">
                                <label for="elementary">Elementary</label>
                                <input type="radio" id="elementary" name="educationOption" value="Elementary">

                            </div>
                            <div class="col">
                                <label for="secondary">Secondary</label>
                                <input type="radio" id="secondary" name="educationOption" value="Secondary">
                            </div>
                            <div class="col">
                                <label for="secondaryandshs">Secondary & SHS</label>
                                <input type="radio" id="secondaryandshs" name="educationOption" value="SecondaryandSHS">
                            </div>
                            <div class="col">
                                <label for="shs">SHS Only</label>
                                <input type="radio" id="shs" name="educationOption" value="SHS">
                            </div>
                        </div>
                    </div>
                      <!-- Elementary Input Field -->
                    <div class="form-group gradeInput" id="grade1Input" style="display: none;">
                        <label for="grade1Text">Grade 1:</label>
                          <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                    </div>

                        <div class="form-group gradeInput" id="grade2Input" style="display: none;">
                            <label for="grade2Text">Grade 2:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade3Input" style="display: none;">
                            <label for="grade3Text">Grade 3:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade4Input" style="display: none;">
                            <label for="grade4Text">Grade 4:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade5Input" style="display: none;">
                            <label for="grade5Text">Grade 5:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade6Input" style="display: none;">
                            <label for="grade6Text">Grade 6:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                          <!-- //Secondary Input Field -->
                          <div class="form-group gradeInput" id="grade7Input" style="display: none;">
                            <label for="grade7Text">Grade 7:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade8Input" style="display: none;">
                            <label for="grade8Text">Grade 8:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade9Input" style="display: none;">
                            <label for="grade9Text">Grade 9:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <div class="form-group gradeInput" id="grade10Input" style="display: none;">
                            <label for="grade10Text">Grade 10:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Mother Tongue:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Filipino:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="col">
                                <label for="english">English:</label>
                                <input type="text" id="english" name="english">
                            </div>
                            <div class="col">
                                <label for="math">Mathematics:</label>
                                <input type="text" id="math" name="math">
                            </div>
                            <!-- Add more subjects as needed -->
                        </div>
                        </div>
                        <!-- SHS Input Field -->
                        <div class="form-group gradeInput" id="grade11Input" style="display: none;">
                            <label for="grade11Text">Grade 11:</label>
                            <div class="row">
                            <div class="col">
                                <label for="mt">Core Subject:</label>
                                <input type="text" id="mt" name="mt">
                            </div>
                            <div class="col">
                                <label for="filipino">Applied Subject:</label>
                                <input type="text" id="filipino" name="filipino">
                            </div>
                            <div class="row">
                                <label for="english">Specialized Subject:</label>
                                <input type="text" id="english" name="english">
                            </div>
                        </div>
                        </div>
                                        <!-- Grade 12 Input Field -->
                    <div class="form-group gradeInput" id="grade12Input" style="display: none;">
                        <label for="grade12Text">Grade 12:</label>
                        <div class="row">
                            <div class="col">
                                <label for="coreSubject">Core Subject:</label>
                                <input type="text" id="coreSubject" name="coreSubject">
                            </div>
                            <div class="col">
                                <label for="appliedSubject">Applied Subject:</label>
                                <input type="text" id="appliedSubject" name="appliedSubject">
                            </div>
                            <div class="row">
                                <label for="specializedSubject">Specialized Subject:</label>
                                <input type="text" id="specializedSubject" name="specializedSubject">
                            </div>
                        </div>
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
                                <label for="quarter3">Q3</label>
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
                        <button type="button" id="saveRetention" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // jQuery script to show/hide input fields based on radio button selection
    $(document).ready(function () {
        // Function to hide all grade input fields
        function hideAllGradeFields() {
            $('.gradeInput').hide();
        }

        // Function to show grade input fields based on the selected radio button
        function showGradeFields(selectedOption) {
            hideAllGradeFields(); // Hide all fields first

            // Show grade input fields based on the selected radio button
            if (selectedOption === 'Elementary') {
                $('#grade1Input, #grade2Input, #grade3Input, #grade4Input, #grade5Input, #grade6Input').show();
            } else if (selectedOption === 'Secondary') {
                $('#grade7Input, #grade8Input, #grade9Input, #grade10Input').show();
            } else if (selectedOption === 'SHS') {
                $('#grade11Input, #grade12Input').show();
            }
        }

        // Trigger the function on page load
        hideAllGradeFields();

        // Bind the function to the change event of radio buttons
        $('input[name="educationOption"]').on('change', function () {
            var selectedOption = $('input[name="educationOption"]:checked').val();
            showGradeFields(selectedOption);
        });

        // Bind the function to handle deselection of radio buttons
        $('input[name="educationOption"]').on('click', function () {
            var selectedOption = $('input[name="educationOption"]:checked').val();

            // If no radio button is selected, hide all grade input fields
            if (!selectedOption) {
                hideAllGradeFields();
            }
        });
    });

    // Handle save button click
    $("#saveRetention").on("click", function () {
        // Your save logic here
        // e.g., $("#retentionForm").submit();
    });
</script>






<!-- Include jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    // When the form is submitted, show the confirmation modal
    $("#retentionForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission
        $("#retentionEducationModal").modal("show");
    });

    // When the "Save" button in the modal is clicked, submit the form
    $("#saveRetention").on("click", function() {
        $("#retentionForm").off("submit"); // Remove the previous event handler
        $("#retentionForm").submit(); // Submit the form
    });

    $("#confirm_overwrite").on("click", function() {
        // Submit the form when "Yes" is clicked
        $("#retentionForm").submit();
    });
});
</script>

