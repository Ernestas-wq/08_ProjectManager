<?php
require('../../partials/head.php');
require('../../partials/navbar.php');
if($_SERVER['REQUEST_METHOD'] === "POST") {
echo '<h1 class="text-center">New Employee</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="employees.php" method="POST" novalidate class="validated-form">
        <input type="hidden" name="emp" value="y">
        <input type="hidden" name="new" value="y">
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
                <button class="btn btn-success" type="submit">Add employee</button>
            </div>
        </form>
    </div>
</div>';
}
else echo '<h2 class="display-3 text-center text-danger">Sorry something went wrong </h2> ';



require('../../partials/footer.php');
