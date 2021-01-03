<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['assign'])) {
$proj_id = $_POST['proj_id'];
$first = $_POST['firstname'];
$last = $_POST['lastname'];
    if($proj_id && $first && $last) {
        $assign_emp = "SELECT id AS emp_id
        FROM employees
        WHERE firstname='$first'
        AND lastname='$last';";
    }

}


?>