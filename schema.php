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
$username = "admin";
$password = "adm";

// Creating DB
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL = "CREATE DATABASE IF NOT EXISTS ProjectManagerDB DEFAULT CHARACTER SET utf8mb4 COLLATE
utf8mb4_lithuanian_ci DEFAULT ENCRYPTION='N'";
    // No results are returned so using exec
    $conn->exec($SQL);
    echo '<h2 class="display-3 text-center text-info">Database created successfully</h2>';
} catch (PDOException $e) {
    echo '<h2 class="display-3 text-center text-danger">Failed creating database</h2><br>'
    . $e->getMessage();
};
$conn = null;

?>

<?php
// Create tables
$db_name = "ProjectManagerDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $SQL_TABLES = "CREATE TABLE IF NOT EXISTS Employees (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname varchar(30) NOT NULL,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=INNODB;
CREATE TABLE IF NOT EXISTS Projects(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(30) NOT NULL
    ) ENGINE=INNODB;
CREATE TABLE IF NOT EXISTS Employees_Projects(
    employee_id INT UNSIGNED,
    project_id INT UNSIGNED,
    FOREIGN KEY (employee_id) REFERENCES Employees(id),
    FOREIGN KEY (project_id) REFERENCES Projects(id),
    UNIQUE (employee_id, project_id)
    ) ENGINE=INNODB;";
    $conn->exec($SQL_TABLES);
    echo '<h2 class="display-3 mt-4 text-center text-info">Tables created successfully</h2>';
} catch (PDOException $e) {
    echo '<h2 class="display-3 mt-3 text-center text-danger">Failed creating tables</h2><br>'
    . $e->getMessage();
};
$conn = null;

?>
</body>

</html>