<?php
Class Project {
    private $project_name;
    private $employees = array();
    function get_project_name() {return $this->project_name;}
    function set_project_name($name) {$this->project_name = $name;}
    function populate_employees($emp) {array_push($this->employees, $emp);}
    function get_employees() {
        return implode(', ', $this->employees);
    }
}