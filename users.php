<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
// Creating app user and app viewer
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL = "CREATE USER IF NOT EXISTS 'app_user'@'localhost' IDENTIFIED BY 'app';
    GRANT DELETE, INSERT, SELECT, UPDATE ON projectmanagerdb.* TO 'app_user'@'localhost';
    CREATE USER IF NOT EXISTS 'app_viewer'@'localhost' IDENTIFIED BY 'viewer';
    GRANT SELECT ON projectmanagerdb.* TO 'app_viewer'@'localhost';
    ";
    $conn->exec($SQL);
    echo 'User created successfully';
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}