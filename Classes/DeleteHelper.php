<?php declare(strict_types=1)?>
<?php
Class DeleteHelper {

    public static function delete_emp(PDO $conn, int $id) :void{
        $que = "DELETE FROM employees_projects
        WHERE employee_id = $id;
        DELETE FROM employees
        WHERE id = $id;";
        $conn->exec($que);
    }
    public static function delete_proj(PDO $conn, int $id) :void {
        $que = "DELETE FROM employees_projects
        WHERE project_id = $id;
        DELETE FROM projects
        WHERE id = $id;";
        $conn->exec($que);
    }


}


?>