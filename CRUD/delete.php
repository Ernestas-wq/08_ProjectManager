<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['confirm_delete'])) {
$emp_id = $_POST['emp_id'];
$proj_id = $_POST['proj_id'];
#Delete Employee and all connections to projects
if($emp_id) {
    $delete_emp = "DELETE FROM employees_projects
    WHERE employee_id = $emp_id;
    DELETE FROM employees
    WHERE id = $emp_id;";
}

if($proj_id) {
    $delete_proj = "DELETE FROM employees_projects
    WHERE project_id = $proj_id;
    DELETE FROM projects
    WHERE id = $proj_id;";
}

#Delete Project

}