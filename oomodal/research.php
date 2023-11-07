<!-- Modal for "Research Completed" -->
<div class="modal fade" id="researchCompletedModal" tabindex="-1" role="dialog" aria-labelledby="researchCompletedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="researchCompletedModalLabel">Research Completed Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your content for the modal here -->
                <input type="hidden" id="schoolId" name="schoolId" value="YOUR_SCHOOL_ID">

                <label for="researchCompleted">Research Completed</label>
                <input type="text" id="researchCompleted" name="researchCompleted" class="form-control" placeholder="Enter Research Completed">

                <div class="form-group">
                    <label>Quarters</label>
                    <div class="row">
                        <div class="col">
                            <label for="quarter1">Q1</label>
                            <input type="checkbox" id="quarter1" name="quarter[]" value="1">
                        </div>
                        <div class="col">
                            <label for="quarter2">Q2</label>
                            <input type="checkbox" id="quarter2" name="quarter[]" value="2">
                        </div>
                        <div class="col">
                            <label for="quarter3">Q3</label>
                            <input type="checkbox" id="quarter3" name="quarter[]" value="3">
                        </div>
                        <div class="col">
                            <label for="quarter4">Q4</label>
                            <input type="checkbox" id="quarter4" name="quarter[]" value="4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
