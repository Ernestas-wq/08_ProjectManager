<?php
session_start();
require '../../partials/head.php';
require '../../partials/navbar.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_SESSION['logged_in']) {
        echo '<h1 class="text-center">Assign '. $_POST['fullname'] .' to Project</h1>
    <h5 class="mt-2 text-center font-weight-lighter font-italic">NOTE: This is case sensitive</h5>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="show.php" method="POST" novalidate class="validated-form">
            <input type="hidden" name="assign_emp_to_proj" value="y">
            <input type="hidden" name="show" value="y">
            <input type="hidden" name="emp_id" value=' . $_POST['id'] . '>
                <div class="mb-3">
                    <label class="form-label" for="project_name">Project name</label>
                    <input class="form-control" type="text" id="project_name" name="project_name" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-success" type="submit">Assign</button>
                </div>
            </form>



        </div>
    </div>';
    } else {
        echo '<h2 class="display-3 text-center text-danger">Please login to assign an employee to this project</h2>';
    }

} else {
    echo '<h2 class="display-3 text-center text-danger">Sorry something went wrong </h2> ';
}

require '../../partials/footer.php';
