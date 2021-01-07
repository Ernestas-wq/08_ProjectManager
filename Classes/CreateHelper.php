<?php declare (strict_types = 1) ?>
<?php
class CreateHelper
{
    public static function create_emp(PDO $conn, string $first, string $last): void
    {
        $que = "INSERT INTO employees
        (firstname, lastname)
        VALUES ('$first', '$last');";
        $conn->exec($que);
    }
    public static function create_proj(PDO $conn, string $name): void
    {
        $que = "INSERT INTO projects
        (project_name)
        VALUES ('$name')";
        $conn->exec($que);
    }
}
