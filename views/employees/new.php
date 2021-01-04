<?php
session_start();

require('../../partials/head.php');
require('../../partials/navbar.php');
if($_SESSION['logged_in']) {
echo '<h1 class="text-center">New Employee</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="show.php" method="POST" novalidate class="validated-form">
        <input type="hidden" name="show" value="y">
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
else echo '<h2 class="display-3 text-center text-danger">Pleaes login to add an employee</h2> ';



require('../../partials/footer.php');
