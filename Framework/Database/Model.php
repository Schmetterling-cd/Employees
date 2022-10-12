<?php
include_once '/var/www/vlad/Employees/autoload.php';
include '/var/www/vlad/Employees/config.php';

abstract class Model
{
    protected static $DB ;
    public function __construct()
    {
        self::$DB = new Database(DB_URL,DB_USER,DB_PASSWORD,DB_NAME);
    }

    abstract protected function List($from, $to);
    abstract protected function Create($FirstName,$SecondName,$Birthday,$Salary);
    abstract protected function Update($id,$FirstName,$SecondName,$Birthday,$Salary);
    abstract protected function Delete($id);
}
?>