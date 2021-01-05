<?php
$servername = "localhost";
$username = "app_user";
$password = "app";
$db_name = "ProjectManagerDB";
require('seedData.php');

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
    for ($i = 1; $i <= 50; $i++) {
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
        $randEmp = mt_rand(1, 50);
        $SQL = "INSERT INTO projectmanagerdb.employees_projects
                (project_id, employee_id)
                VALUES ($i+1, $randEmp);";
        array_push($combos, [$i + 1, $randEmp]);
        $conn->exec($SQL);
    }
    // print_r($combos);

    // Making some more random connections
    for ($i = 0; $i < 45; $i++) {
        $randEmp = mt_rand(1, 45);
        $randProject = mt_rand(1, count($seedsProjects));
        $SQL = "INSERT INTO projectmanagerdb.employees_projects
                (project_id, employee_id)
                VALUES ($randProject, $randEmp)";
        if (!in_array([$randProject, $randEmp], $combos)){
            array_push($combos, [$randProject, $randEmp]);
            $conn->exec($SQL);
        }
    };

    echo 'Seeded successfully';
} catch (PDOException $e) {
    echo $SQL . "<br>"  . $e->getMessage();
}
$conn = null;
