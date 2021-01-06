<?php declare(strict_types=1)?>
<?php
class Employee
{
    private $firstname;
    private $lastname;
    private $projects = array();

    function set_firstname(string $firstname)  { $this->firstname = $firstname;}

    function get_firstname() {return $this->firstname;}

    function set_lastname(string $lastname){ $this->lastname = $lastname;}

    function get_lastname() {return $this->lastname;}
    function get_fullname(){return $this->firstname . " " . $this->lastname;}
    function populate_projects(string $proj){array_push($this->projects, $proj);}
    function get_projects(){ return implode(', ',  $this->projects); }
}
