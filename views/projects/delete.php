<?php declare(strict_types=1);?>
<?php
function display_delete_modal(string $name, int $id) {
    echo '<div class="modal fade mt-5" tabindex="-1" style="display:block;opacity:1" id="deleteProjModal">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header mt-2">
           <h5 class="modal-title">Are you sure you want to delete '. $name.' from the database?</h5>
         </div>
         <div class="modal-body">
         <div class="container d-flex flex-row justify-content-around">
         <form method="POST" action="show.php">
         <input type="hidden" name="confirm_delete" value="y">
         <input type="hidden" name="show" value="y">
         <input type="hidden" name="project_name" value="'.$_POST['project_name'].'">
         <input type="hidden" name="proj_id" value="'. $id .'">
         <button type="submit" class="btn btn-success">Yes</button>
         </form>
         <button type="button" class="btn btn-danger closeDeleteProjModal">No</button>
     </div>
         </div>
       </div>
     </div>
   </div>';
 }