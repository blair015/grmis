<?php
  $userID = $_POST['current_user_id'];
  $user = $_POST['current_username']; 
  $role = $_POST['current_user_role'];
  $key = $_POST['security_key'];
	
  if (empty($userID)) {
    echo "<p>String is Empty</p>";
	header("Location: http://202.137.126.58/");
exit();
  } else {
    	echo "<p>ID: " . $userID . "</p>";
	echo "<p>Username: " .  $user . "</p>";
	echo "<p>User role: " . $role . "</p>";
	echo "<p>server key: " . $key . "</p>";


  }
?>

<!-- edit about school profile modal -->
<div class="modal fade" id="editaboutModal" tabindex="-1" role="dialog" aria-labelledby="editaboutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editaboutModalLabel">Edit Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Edit Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
