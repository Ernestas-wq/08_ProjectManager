<?php declare(strict_types=1)?>
<?php
Class Helper {

    public static function get_min_id_per_page(object $conn,int $res,int $offs, string $table){
            $id_values_10 = [];
            $min_max = "SELECT id FROM $table
            LIMIT $res OFFSET $offs;";
            $stmt = $conn->prepare($min_max);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                array_push($id_values_10, $v['id']);
            }
           return min($id_values_10);
    }

    public static function get_max_id_per_page(object $conn, int $res, int $offs, string $table) {
            $id_values_10 = [];
            $que = "SELECT id FROM $table
            LIMIT $res OFFSET $offs;";
            $stmt = $conn->prepare($que);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                array_push($id_values_10, $v['id']);
            }
           return max($id_values_10);
    }
    public static function get_max_overall_id($conn, $table){
        $que = "SELECT MAX(id) AS max_id FROM $table";
        $stmt = $conn->prepare($que);
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v ){
            $max_id = $v['max_id'];
        }
        return $max_id;
    }
}

?>