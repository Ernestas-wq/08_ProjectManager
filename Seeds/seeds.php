<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body  class="d-flex flex-column vh-100 container">
<?php
$servername = "localhost";
$username = "app_user";
$password = "app";
$db_name = "ProjectManagerDB";
require('seedData.php');
$EMPS_TO_GENERATE = 50;
$CONNECTIONS_TO_GENERATE = 45;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Clear previous data
    $clear = "DELETE FROM projectmanagerdb.employees_projects;
              DELETE FROM projectmanagerdb.employees;
              DELETE FROM projectmanagerdb.projects;
              ";
    $conn->exec($clear);
    // Seeding Employees
    for ($i = 1; $i <= $EMPS_TO_GENERATE; $i++) {
        $randFirst = mt_rand(0, count($seedsFirstNames) - 1);
        $randLast = mt_rand(0, count($seedsLastNames) - 1);
        $SQL = "INSERT INTO projectmanagerdb.employees
                (id, firstname, lastname)
                VALUES ($i, '$seedsFirstNames[$randFirst]', '$seedsLastNames[$randLast]')";
        $conn->exec($SQL);
    }
    // Seeding Projects
    for ($i = 0; $i < count($seedsProjects); $i++) {
        $project = $seedsProjects[$i];
        $SQL = "INSERT INTO projectmanagerdb.projects
                (id, project_name)
                VALUES ($i+1, '$project')";
        $conn->exec($SQL);
    }
    // Seeding connections between projects and employees
    // First we make sure each project has atleast 1 Employee
    $combos = [];
    for ($i = 0; $i < count($seedsProjects); $i++) {
        $randEmp = mt_rand(1, $EMPS_TO_GENERATE);
        $SQL = "INSERT INTO projectmanagerdb.employees_projects
                (project_id, employee_id)
                VALUES ($i+1, $randEmp);";
        array_push($combos, [$i + 1, $randEmp]);
        $conn->exec($SQL);
    }
    // print_r($combos);

    // Making some more random connections
    for ($i = 0; $i < $CONNECTIONS_TO_GENERATE; $i++) {
        $randEmp = mt_rand(1, $EMPS_TO_GENERATE);
        $randProject = mt_rand(1, count($seedsProjects));
        $SQL = "INSERT INTO projectmanagerdb.employees_projects
                (project_id, employee_id)
                VALUES ($randProject, $randEmp)";
        if (!in_array([$randProject, $randEmp], $combos)){
            array_push($combos, [$randProject, $randEmp]);
            $conn->exec($SQL);
        }
    };

    echo '<h2 class="display-3 text-center text-info">Database seeded successfully</h2>';
} catch (PDOException $e) {
    echo '<h2 class="display-3 text-center text-info">Error seeding database</h2><br>'
    . $e->getMessage();
}
$conn = null;
?>
</body>

</html>