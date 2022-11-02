<?php
    include_once '/var/www/vlad/Employees/autoload.php';

    class EmployeeModel extends Model
    {
        public function __construct(){
            $this->setDB();
        }       
    }
?>