<?php
session_start();
require '../../partials/head.php';
require '../../partials/navbar.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_SESSION['logged_in']) {
        echo '<h1 class="text-center">Update Employee</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="show.php" method="POST" novalidate class="validated-form">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="emp_id" value="' . $_POST['id'] . '">
            <div class="mb-3">
                <label class="form-label" for="firstname">Firstname</label>
                <input class="form-control" type="text" id="firstname" name="firstname"
                value="' . $_POST['firstname'] . '" required>
                <div class="valid-feedback">
                             Looks good!
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="lastname">Lastname</label>
                <input class="form-control" type="text" id="lastname" name="lastname"
                value="' . $_POST['lastname'] . '" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Edit employee</button>
            </div>
        </form>
    </div>
</div>';
    } else {
        echo '<h2 class="display-3 text-center text-danger">Please login to edit an employee</h2>';
    }

} else {
    echo '<h2 class="display-3 text-center text-danger">Sorry something went wrong</h2> ';
}

require '../../partials/footer.php';
