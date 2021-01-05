<?php declare(strict_types=1)?>
<?php
Class EditHelper {
    public static function edit_emp(PDO $conn, string $first, string $last, int $id) :void{
        $que = "UPDATE employees
        SET firstname = '$first',
            lastname = '$last'
            WHERE id = $id;";
        $conn->exec($que);
    }
    public static function edit_proj(PDO $conn, string $name, int $id) :void {
        $que = "UPDATE projects
        SET project_name = '$name'
        WHERE id = $id";
        $conn->exec($que);
    }
}


?>