<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>
    <?php
    // require('.././Classes/Project.php');
    require('../../partials/navbar.php');
    require('../../Classes/Project.php');
    require('../../CRUD/create.php');
    require('../../CRUD/update.php');
    require('../../CRUD/delete.php');
    require('delete.php');

    if(isset($_POST['proj'])){
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $db_name = "ProjectManagerDB";
    }
    $projects = [];
    echo '<h1 class="text-center mt-5 display-2 text-primary">All Projects</h1>';
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
            // echo $v['id'] . " " . $v['project_name'] . " " . $v['firstname'] . "<br>";
            $fullname = $v['firstname'] . " " . $v['lastname'];
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
    <table class="table table-bordered">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Project ID</th>
        <th scope=col">Project Name</th>
        <th scope="col">Employees</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
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
        <td><form method="POST" action="projects.php">
        <input type="hidden" name="proj" value="y">
        <input type="hidden" name="project_name" value="'.$projects[$k]->get_project_name().'">
        <input type="hidden" name="delete" value="'.$k.'">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>


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





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="../../js/utils.js"></script>

</body>

</html>