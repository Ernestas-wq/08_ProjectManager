<?php
class Employee
{
    private $firstname;
    private $lastname;
    private $projects = array();

    function set_firstname($firstname)  { $this->firstname = $firstname;}

    function get_firstname() {return $this->firstname;}

    function set_lastname($lastname){ $this->lastname = $lastname;}

    function get_lastname() {return $this->lastname;}
    function get_fullname(){return $this->firstname . " " . $this->lastname;}
    function populate_projects($proj){array_push($this->projects, $proj);}
    function get_projects(){ return implode(', ',  $this->projects); }
}
