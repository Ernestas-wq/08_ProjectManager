<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
// Creating app user and app viewer
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL = "CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'adm';
    GRANT CREATE, DELETE, DROP, INSERT, SELECT, REFERENCES, UPDATE, GRANT OPTION ON projectmanagerdb.*
    TO 'admin'@'localhost';
    CREATE USER IF NOT EXISTS 'app_user'@'localhost' IDENTIFIED BY 'app';
    GRANT DELETE, INSERT, SELECT, UPDATE ON projectmanagerdb.*
    TO 'app_user'@'localhost';
    CREATE USER IF NOT EXISTS 'app_viewer'@'localhost' IDENTIFIED BY 'viewer';
    GRANT SELECT ON projectmanagerdb.*
    TO 'app_viewer'@'localhost';
    FLUSH PRIVILEGES;
    ";
    $conn->exec($SQL);
    echo 'Users created successfully';
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}