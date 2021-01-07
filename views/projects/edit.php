<?php
session_start();
require '../../partials/head.php';
require '../../partials/navbar.php';
require '../../Classes/ShowHelper.php';
require '../../Classes/EditHelper.php';
require 'unassign.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === "POST" && $_SESSION['logged_in'] && isset($_POST['edit'])) {
    $servername = "localhost";
    $db_name = "ProjectManagerDB";
    if ($_SESSION['app_user']) {
        $username = "app_user";
        $password = "app";
    } else {
        $username = "app_viewer";
        $password = "viewer";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['edit'])) {
    if ($_SESSION['logged_in']) {

        echo '<h1 class="text-center">Update Project
<span class="font-italic font-weight-light"> ' . $_POST['project_name'] . '</span>
</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="show.php" method="POST" novalidate class="validated-form">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="proj_id" value=' . $_POST['proj_id'] . '>
            <div class="mb-3">
                <label class="form-label" for="project_name"></label>
                <input class="form-control" type="text" id="project_name" name="project_name"
                value="' . $_POST['project_name'] . '"required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
         <div class="mb-3">
                <button class="btn btn-success" type="submit">Update name</button>
            </div>
        </form>';

        if (isset($_POST['unassign'])) {
            displayUnassignModal($_POST['project_name'], $_POST['emp_name'],
                $_POST['emp_id'], $_POST['proj_id']);
        }

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_POST['confirm_unassign'])) {
                EditHelper::unassign_emp_from_proj($conn, $_POST['emp_id'], $_POST['proj_id']);
                echo '<h4 class="text-center mt-3 display-5">Unassigned successfully</h4>';

            }

            echo '<table class="table mt-4 table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope=col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col" style="width: 170px">Unassign Employee</th>
        </tr>
        </thead>
        <tbody>';

            $stmt = ShowHelper::show_all_emps_in_proj($conn, $_POST['proj_id']);
            foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                if ($v['id'] && $v['firstname'] && $v['lastname']) {
                    echo '<tr>
        <th scope="row">' . $v['id'] . '</th>
        <td>' . $v['firstname'] . ' </td>
        <td>' . $v['lastname'] . '</td>
        <td>
        <form class="d-flex justify-content-center" method="POST" action="edit.php">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="unassign" value="y">
        <input type="hidden" name="emp_id" value="' . $v['id'] . '">
        <input type="hidden" name="proj_id" value="' . $_POST['proj_id'] . '">
        <input type="hidden" name="project_name" value="' . $_POST['project_name'] . '">
        <input type="hidden" name="emp_name" value="' . $v['firstname'] . " " . $v['lastname'] . '">
        <input type="hidden" name="unassign" value="y">
        <button type="submit" class="btn btn-warning">Unassign</button>
        </form></td>
        </tr>';
                } else {
                    echo '<h2 class="display-6 text-center">No employees yet assigned </h2>';
                }
            }
            echo '</tbody>
     </table>
     ';

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo '</div></div>';

    } else {
        echo '<h2 class="display-3 text-center text-danger">Please login to edit a project</h2>';
    }

} else {
    echo '<h2 class="display-3 text-center text-danger">Sorry something went wrong </h2> ';
}

require '../../partials/footer.php';
