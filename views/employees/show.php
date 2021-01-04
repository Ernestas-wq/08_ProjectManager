<?php
session_start();

if(isset($_POST['emp']) && $_SESSION['logged_in']) {
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

require('../../partials/head.php');

?>



    <?php
    require('../../partials/navbar.php');
    require('../../Classes/Employee.php');
    require('../../CRUD/create.php');
    require('../../CRUD/update.php');
    require('../../CRUD/delete.php');
    require('delete.php');
    echo '<h1 class="text-center mt-3 display-3 text-secondary">All Employees</h1>';

    $employees = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        # Delete modal to confirm
        if($_POST['delete']) displayDeleteModal($_POST['fullname'], $_POST['delete']);
        # If confirmed deleting from DB
        if($delete_emp) {
            $conn->exec($delete_emp);
            echo '<h4 class="text-center mt-3 display-4">Employee deleted successfully</h4>';
        }

        if($create_emp) {
            $conn->exec($create_emp);
            echo '<h4 class="text-center mt-3 display-4">Employee added successfully </h4>';
        };
        if($update_emp) {
            $conn->exec($update_emp);
            echo '<h4 class="text-center mt-3 display-4">Employee updated successfully </h4>';
        }

        $stmt = $conn->prepare(
            "SELECT employees.id, firstname, lastname, project_name
            FROM employees
            LEFT JOIN employees_projects
            ON employees.id = employees_projects.employee_id
            LEFT JOIN projects
            ON projects.id = employees_projects.project_id
            ORDER BY employees.id"
        );
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {


            // Grouping projects to an employee for display purposes
            if (array_key_exists($v['id'], $employees) && $v['project_name']) {
                $employees[$v['id']]->populate_projects($v['project_name']);
            } else {
                $e = new Employee();
                $e->set_firstname($v['firstname']);
                $e->set_lastname($v['lastname']);
                $e->populate_projects($v['project_name']);
                $employees += [$v['id'] => $e];
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

    if(count($employees) > 0) {
    echo '<div class="container mt-5 mb-5">
    <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope=col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Projects</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>';

    foreach ($employees as $k => $v) {
        echo '<tr>
        <th scope="row"> ' . $k . ' </th>
        <td> ' . $employees[$k]->get_firstname() . '</td>
        <td> ' . $employees[$k]->get_lastname() . '</td>
        <td> ' . $employees[$k]->get_projects() . '</td>
        <td><form method="POST" action="edit.php">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="firstname" value= '. $employees[$k]->get_firstname() . '>
        <input type="hidden" name="lastname" value= '. $employees[$k]->get_lastname() . '>
        <input type="hidden" name="id" value = '. $k .'>
        <button type="submit" class="btn btn-success">Update </button>
        </form></td>
        <td><form method="POST" action="show.php">
        <input type="hidden" name="emp" value="y">
        <input type="hidden" name="fullname" value="'.$employees[$k]->get_fullname().'">
        <input type="hidden" name="delete" value="'.$k.'">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>
        </tr>';
        // echo $k . " " . $employees[$k]->get_firstname() . " "
        //     . $employees[$k]->get_projects();
        // echo '<br>';
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
