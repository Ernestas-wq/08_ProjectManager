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
    require('../../partials/navbar.php');
    require('../../Classes/Employee.php');
    require('../../CRUD/create.php');
    echo '<h1 class="text-center mt-5 display-2 text-primary">All Employees</h1>';

    if (isset($_POST['emp'])) {
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $db_name = "ProjectManagerDB";
    }

    $employees = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($create_emp) {
            $conn->exec($create_emp);
            echo '<h4 class="text-center mt-3 display-4">Employee added successfully </h4>';
        };


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
            // echo $v['id'] . " "
            //     . $v['firstname'] . " "
            //     . $v['lastname'] . " "
            //     . $v['project_name'] . '<br>';
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
    <table class="table table-bordered">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Employee ID</th>
        <th scope=col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Projects</th>
        </tr>
        </thead>
        <tbody>';

    foreach ($employees as $k => $v) {
        echo '<tr>
        <th scope="row"> ' . $k . ' </th>
        <td> ' . $employees[$k]->get_firstname() . '</td>
        <td> ' . $employees[$k]->get_lastname() . '</td>
        <td> ' . $employees[$k]->get_projects() . '</td>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>