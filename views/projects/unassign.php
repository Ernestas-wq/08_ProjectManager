<?php declare (strict_types = 1); ?>
<?php
function displayUnassignModal(string $proj_name, string $emp_name, int $emp_id, int $proj_id)
{
    echo '<div class="modal fade mt-5" tabindex="-1" style="display:block;opacity:1" id="unassignEmpModal">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header mt-2">
           <h5 class="modal-title">Are you sure you want to unassign ' . $emp_name . ' from ' . $proj_name . '?</h5>
         </div>
         <div class="modal-body">
         <div class="container d-flex flex-row justify-content-around">
         <form method="POST" action="edit.php">
         <input type="hidden" name="confirm_unassign" value="y">
         <input type="hidden" name="edit" value="y">
         <input type="hidden" name="project_name" value="' . $proj_name . '">
         <input type="hidden" name="emp_id" value="' . $emp_id . '">
         <input type="hidden" name="proj_id" value="' . $proj_id . '">
         <button type="submit" class="btn btn-success">Yes</button>
         </form>
         <button type="button" class="btn btn-danger closeUnassignEmpModal">No</button>
     </div>
         </div>
       </div>
     </div>
   </div>';
}
