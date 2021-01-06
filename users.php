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
    echo '<h2 class="display-3 text-center text-info">Users created successfully</h2>';
}
catch(PDOException $e) {
    echo '<h2 class="display-3 text-center text-info">Error creating users</h2><br>'
    . $e->getMessage();
}
?>
</body>

</html>