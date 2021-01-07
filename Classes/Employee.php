<?php declare (strict_types = 1) ?>
<?php
class Employee
{
    private $firstname;
    private $lastname;
    private $projects = array();

    public function set_firstname(string $firstname)
    {$this->firstname = $firstname;}

    public function get_firstname()
    {return $this->firstname;}

    public function set_lastname(string $lastname)
    {$this->lastname = $lastname;}

    public function get_lastname()
    {return $this->lastname;}

    public function get_fullname()
    {return $this->firstname . " " . $this->lastname;}

    public function populate_projects(string $proj)
    {array_push($this->projects, $proj);}

    public function get_projects()
    {return implode(', ', $this->projects);}
}
