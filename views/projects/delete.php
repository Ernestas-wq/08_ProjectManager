<?php
function displayDeleteModal($name, $id) {
    echo '<div class="modal fade mt-5" tabindex="-1" style="display:block;opacity:1" id="delete_proj_modal">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header mt-2">
           <h5 class="modal-title">Are you sure you want to delete '. $name.' from the database?</h5>
         </div>
         <div class="modal-body">
         <div class="container d-flex flex-row justify-content-around">
         <form method="POST" action="show.php">
         <input type="hidden" name="confirm_delete" value="y">
         <input type="hidden" name="proj" value="y">
         <input type="hidden" name="proj_id" value="'. $id .'">
         <button type="submit" class="btn btn-success">Yes</button>
         </form>
         <button type="button" class="btn btn-danger close_delete_proj_modal">No</button>
     </div>
         </div>
       </div>
     </div>
   </div>';
 }