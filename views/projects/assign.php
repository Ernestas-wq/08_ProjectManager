<?php
session_start();
require '../../partials/head.php';
require '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_SESSION['logged_in']) {
        echo '<h1 class="text-center">Assign Employee to ' . $_POST['project_name'] . '</h1>
    <h5 class="mt-2 text-center font-weight-lighter font-italic">NOTE: This is case sensitive, use id if there might be duplicates</h5>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="show.php" method="POST" novalidate class="validated-form">
            <input type="hidden" name="assign_by_fullname" value="y">
            <input type="hidden" name="show" value="y">
            <input type="hidden" name="project_name" value="' . $_POST['project_name'] . '">
            <input type="hidden" name="proj_id" value=' . $_POST['id'] . '>
                <div class="mb-3">
                    <label class="form-label" for="firstname">Firstname</label>
                    <input class="form-control" type="text" id="firstname" name="firstname" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="lastname">Lastname</label>
                    <input class="form-control" type="text" id="lastname" name="lastname" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

                <div class="mb-3">
                    <button class="btn btn-success" type="submit">Assign by full name</button>
                </div>
            </form>

            <form action="show.php" method="POST" novalidate class="validated-form">
            <input type="hidden" name="assign_by_id" value="y">
            <input type="hidden" name="show" value="y">
            <input type="hidden" name="project_name" value="' . $_POST['project_name'] . '">
            <input type="hidden" name="proj_id" value=' . $_POST['id'] . '>
            <div class="mb-3">
            <label class="form-label" for="emp_id">Employee id</label>
            <input class="form-control" type="number" id="emp_id" name="emp_id" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="my-3">
                    <button class="btn btn-success" type="submit">Assign by id</button>
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
