<?php declare (strict_types = 1) ?>
<?php
class Project
{
    private $project_name;
    private $employees = array();

    public function get_project_name()
    {return $this->project_name;}

    public function set_project_name(string $name)
    {$this->project_name = $name;}

    public function populate_employees(string $emp)
    {array_push($this->employees, $emp);}

    public function get_employees()
    {return implode(', ', $this->employees);}
}
