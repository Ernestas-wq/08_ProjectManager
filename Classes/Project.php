<?php declare(strict_types=1)?>
<?php
Class Project {
    private $project_name;
    private $employees = array();
    function get_project_name() {return $this->project_name;}
    function set_project_name(string $name) {$this->project_name = $name;}
    function populate_employees(string $emp) {array_push($this->employees, $emp);}
    function get_employees() {
        return implode(', ', $this->employees);
    }
}