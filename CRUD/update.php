<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['edit'])) {
    $emp_id = $_POST['emp_id'];
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $proj = $_POST['project_name'];
    $proj_id = $_POST['proj_id'];

    # Edit employee

    if($first && $last && $emp_id) {
        $update_emp = "UPDATE employees
        SET firstname = '$first',
            lastname = '$last'
            WHERE id = $emp_id";
    }
    # Edit project
    if($proj && $proj_id) {
        print_r($proj, $proj_id);
        $update_proj = "UPDATE projects
        SET project_name = '$proj'
        WHERE id = $proj_id";
    }
 }