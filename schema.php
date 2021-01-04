<?php
$servername = "localhost";
$username = "root";
$password = "mysql";


// Creating DB
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL = "CREATE DATABASE IF NOT EXISTS ProjectManagerDB DEFAULT CHARACTER SET utf8mb4 COLLATE
utf8mb4_lithuanian_ci DEFAULT ENCRYPTION='N'";
    // No results are returned so using exec
    $conn->exec($SQL);
    echo "Database created successfully" . "<br>";
} catch (PDOException $e) {
    echo $SQL . "<br>" . $e->getMessage();
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
    echo "Tables created successfully";
} catch (PDOException $e) {
    echo "Error: " . "<br>" . $e->getMessage();
};
$conn = null;

?>