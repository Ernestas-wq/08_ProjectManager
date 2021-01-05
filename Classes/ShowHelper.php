<?php declare(strict_types=1)?>
<?php
Class ShowHelper {

    public static function get_min_id_per_page(PDO $conn,int $res,int $offs, string $table){
            $id_values = [];
            $min_max = "SELECT id FROM $table
            LIMIT $res OFFSET $offs;";
            $stmt = $conn->prepare($min_max);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                array_push($id_values, $v['id']);
            }
           return min($id_values);
    }

    public static function get_max_id_per_page(PDO $conn, int $res, int $offs, string $table) {
            $id_values = [];
            $que = "SELECT id FROM $table
            LIMIT $res OFFSET $offs;";
            $stmt = $conn->prepare($que);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                array_push($id_values, $v['id']);
            }
           return max($id_values);
    }
    public static function get_max_overall_id(PDO $conn, string $table){
        $que = "SELECT MAX(id) AS max_id FROM $table";
        $stmt = $conn->prepare($que);
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v ){
            $max_id = $v['max_id'];
        }
        return $max_id;
    }
    public static function show_all_emps(PDO $conn, int $min, int $max) {
        $que = "SELECT employees.id, firstname, lastname, project_name
        FROM employees
        LEFT JOIN employees_projects
        ON employees.id = employees_projects.employee_id
        LEFT JOIN projects
        ON projects.id = employees_projects.project_id
        WHERE employees.id BETWEEN $min AND $max
        ORDER BY employees.id;";
        $stmt = $conn->prepare($que);
        // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt;
    }
    public static function show_all_projs(PDO $conn, int $min, int $max) {
        $que = "SELECT projects.id, project_name, firstname, lastname
        FROM projects
        LEFT JOIN employees_projects
        ON projects.id=employees_projects.project_id
        LEFT JOIN employees
        ON employees.id=employees_projects.employee_id
        WHERE projects.id BETWEEN $min AND $max
        ORDER BY projects.id;";
        $stmt = $conn->prepare($que);
        $stmt-> setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();
        return $stmt;
    }

    public static function show_emp_by_id(PDO $conn, int $id) {
        $que = "SELECT employees.id, firstname, lastname, project_name
        FROM employees
        LEFT JOIN employees_projects
        ON employees.id = employees_projects.employee_id
        LEFT JOIN projects
        ON projects.id = employees_projects.project_id
        WHERE employees.id = $id;";
        $stmt = $conn->prepare($que);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt;
    }

    public static function show_emp_by_lastname(PDO $conn, string $lastname) {
        $que = "SELECT employees.id, firstname, lastname, project_name
        FROM employees
        LEFT JOIN employees_projects
        ON employees.id = employees_projects.employee_id
        LEFT JOIN projects
        ON projects.id = employees_projects.project_id
        WHERE employees.lastname = '$lastname';";
        $stmt = $conn->prepare($que);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt;
    }
    public static function show_proj_by_id(PDO $conn, int $id) {
        $que = "SELECT projects.id, project_name, firstname, lastname
        FROM projects
        LEFT JOIN employees_projects
        ON projects.id=employees_projects.project_id
        LEFT JOIN employees
        ON employees.id=employees_projects.employee_id
        WHERE projects.id = $id;";
        $stmt = $conn->prepare($que);
        $stmt-> setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();
        return $stmt;
    }

    public static function show_proj_by_name(PDO $conn, string $name) {
        $que = "SELECT projects.id, project_name, firstname, lastname
        FROM projects
        LEFT JOIN employees_projects
        ON projects.id=employees_projects.project_id
        LEFT JOIN employees
        ON employees.id=employees_projects.employee_id
        WHERE projects.project_name = '$name';";
        $stmt = $conn->prepare($que);
        $stmt-> setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();
        return $stmt;
    }

    public static function get_emp_id_by_fullname(PDO $conn, string $first, string $last){
        $que = "SELECT id AS emp_id
        FROM employees
        WHERE firstname='$first'
        AND lastname='$last';";
         $stmt = $conn->prepare($que);
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $stmt->execute();
         foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
             $emp_id = $v['emp_id'];
         }
         return $emp_id;
    }
    public static function show_all_emps_in_proj(PDO $conn, $id) {
        $que = "SELECT employees.id, firstname, lastname
        FROM projects
        LEFT JOIN employees_projects
        ON projects.id=employees_projects.project_id
        LEFT JOIN employees
        ON employees.id=employees_projects.employee_id
        WHERE projects.id = $id;";
        $stmt = $conn->prepare($que);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        return $stmt;

    }

}

?>