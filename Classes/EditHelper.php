<?php declare (strict_types = 1) ?>
<?php
class EditHelper
{
    public static function edit_emp(PDO $conn, string $first, string $last, int $id): void
    {
        $que = "UPDATE employees
        SET firstname = '$first',
            lastname = '$last'
            WHERE id = $id;";
        $conn->exec($que);
    }
    public static function edit_proj_name(PDO $conn, string $name, int $id): void
    {
        $que = "UPDATE projects
        SET project_name = '$name'
        WHERE id = $id";
        $conn->exec($que);
    }
    public static function assign_emp_to_proj(PDO $conn, int $emp_id, int $proj_id): void
    {
        $que = "INSERT INTO employees_projects
        (employee_id, project_id)
        VALUES ($emp_id, $proj_id)";
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($que);
        $stmt->execute();
        // $conn->exec($que);
    }
    public static function unassign_emp_from_proj(PDO $conn, int $emp_id, int $proj_id): void
    {
        $que = "DELETE FROM employees_projects
        WHERE employee_id = $emp_id
        AND project_id = $proj_id";
        $conn->exec($que);
    }
    public static function assign_proj_to_emp(PDO $conn, int $emp_id, int $proj_id) : void {
        $que = "INSERT INTO employees_projects
        (employee_id, project_id)
        VALUES ($emp_id, $proj_id)";

        $conn->exec($que);
    }

}
