<?php
session_start();
require('../../partials/head.php');
if(isset($_POST['proj']) && $_SESSION['logged_in']) {
    $servername = "localhost";
    $db_name = "ProjectManagerDB";
    if($_SESSION['app_user']){
        $username = "app_user";
        $password = "app";
    }
    else {
        $username = "app_viewer";
        $password = "viewer";
    }
}

?>
    <?php
    // require('.././Classes/Project.php');
    require('../../partials/navbar.php');
    require('../../Classes/Project.php');
    require('../../CRUD/create.php');
    require('../../CRUD/update.php');
    require('../../CRUD/delete.php');
    require('../../CRUD/assign.php');

    require('delete.php');

    // if(isset($_POST['proj'])){
    // $servername = "localhost";
    // $username = "app_user";
    // $password = "app";
    // $db_name = "ProjectManagerDB";
    // }
    $projects = [];
    echo '<h1 class="text-center mt-3 display-3 text-secondary">All Projects</h1>';
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           # Delete modal to confirm
        if($_POST['delete']) displayDeleteModal($_POST['project_name'], $_POST['delete']);
           # If confirmed deleting from DB
        if($delete_proj) {
            $conn->exec($delete_proj);
            echo '<h4 class="text-center mt-3 display-4">Proejct deleted successfully </h4>';
        }
        if($create_proj) {
            $conn->exec($create_proj);
            echo '<h4 class="text-center mt-3 display-4">Proejct added successfully </h4>';
        }
        if($update_proj) {
            $conn->exec($update_proj);
            echo '<h4 class="text-center mt-3 display-4">Proejct updated successfully </h4>';
        }
        # Assign employee to a project
        if($assign_emp) {
            $stmt = $conn->prepare($assign_emp);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                $emp_to_assign = $v['emp_id'];
            }
            $assign_sql = "INSERT INTO employees_projects
            (employee_id, project_id)
            VALUES ($emp_to_assign, $proj_id)";
            $conn->exec($assign_sql);
        }


        $stmt = $conn->prepare(
        "SELECT projects.id, project_name, firstname, lastname
        FROM projects
        LEFT JOIN employees_projects
        ON projects.id=employees_projects.project_id
        LEFT JOIN employees
        ON employees.id=employees_projects.employee_id
        ORDER BY projects.id;");

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();

        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v){
            $fullname = $v['firstname'] . " " . $v['lastname'];

            // Grouping employees to a project, for display purposes
            if(array_key_exists($v['id'], $projects)) {
                $projects[$v['id']]->populate_employees($fullname);
            }
            else {
                $p = new Project();
                $p->set_project_name($v['project_name']);
                $p->populate_employees($fullname);
                $projects += [$v['id'] => $p];
            }
        }
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $conn = null;
    if(count($projects) > 0) {
    echo '<div class="container mt-5 mb-5">
    <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope=col">Name</th>
        <th scope="col">Employees</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        <th scope="col" style="width: 170px">Assign Employee</th>
        </tr>
        </thead>
        <tbody>';

    foreach($projects as $k => $v) {
        echo '<tr>
        <th scope="row"> ' . $k . ' </th>
        <td> ' . $projects[$k]->get_project_name() . '</td>
        <td> ' . $projects[$k]->get_employees() . '</td>
        <td><form method="POST" action="edit.php">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="project_name" value="'. $projects[$k]->get_project_name() .'">
        <input type="hidden" name="id" value = '. $k .'>
        <button type="submit" class="btn btn-success">Update</button>
        </form></td>
        <td><form method="POST" action="show.php">
        <input type="hidden" name="proj" value="y">
        <input type="hidden" name="project_name" value="'.$projects[$k]->get_project_name().'">
        <input type="hidden" name="delete" value="'.$k.'">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>
        <td><form class="d-flex justify-content-center" method="POST" action="assign.php">
        <input type="hidden" name="assign" value="y">
        <input type="hidden" name="project_name" value="'. $projects[$k]->get_project_name() .'">
        <input type="hidden" name="id" value = '. $k .'>
        <button type="submit" class="btn btn-warning">Assign</button>

        </form>
        </td>

        </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
}
    else {
        echo '<h2 class="display-3 text-center">Sorry, failed to retrieve data </h2>';
    }
?>
    <?php
    require('../../partials/footer.php');
?>