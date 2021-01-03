<?php
require('../../partials/head.php');
require('../../partials/navbar.php');
if($_SERVER['REQUEST_METHOD'] === "POST") {
echo '<h1 class="text-center">New Project</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="projects.php" method="POST" novalidate class="validated-form">
        <input type="hidden" name="proj" value="y">
        <input type="hidden" name="new" value="y">
            <div class="mb-3">
                <label class="form-label" for="project_name">Project Name</label>
                <input class="form-control" type="text" id="project_name" name="project_name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
         <div class="mb-3">
                <button class="btn btn-success" type="submit">Add Project</button>
            </div>
        </form>
    </div>
</div>';
}
else echo '<h2 class="display-3 text-center text-danger">Sorry something went wrong </h2> ';


require('../../partials/footer.php');
