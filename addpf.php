<!-- Modal for editing -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-school" style="color: blue; margin-right: 10px;"></i>
                <h5 class="modal-title">Edit Physical Facilities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
                    

                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    ?>

            <form action="update_pf.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="card-body p-9">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Academic Classrooms</h5></label>
                                <input class="form-control form-control-solid" type="text" name="academic_classroom" id="academic_classroom">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Non Academic Classroom</h5></label>
                                <input class="form-control form-control-solid" type="text" name="non_academic_classroom" id="non_academic_classroom">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Needing Repair</h5></label>
                                <input class="form-control form-control-solid" type="text" name="needing_repair" id="needing_repair">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>TLS</h5></label>
                                <input class="form-control form-control-solid" type="text" name="tls" id="tls">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Make Shift:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="make_shift" id="makeshift">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Arm Chairs:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="arm_chairs" id="arm_chairs">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Tables and Chairs:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="tables_and_chairs" id="tables_and_chairs">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-muted"><h5>Functional Clinic:</h5></label>
                                <input class="form-control form-control-solid" type="text" name="functional_clinic" id="functional_clinic">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update_pf">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
