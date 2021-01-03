<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['new'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $proj = $_POST['project_name'];
    if($first && $last) {
        $create_emp = "INSERT INTO employees
        (firstname, lastname)
        VALUES ('$first', '$last');";
    }
    if($proj) {
        $create_proj = "INSERT INTO projects
        (project_name)
        VALUES ('$proj')";
    }
}



