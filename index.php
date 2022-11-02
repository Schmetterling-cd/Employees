<?php 
    include_once '/var/www/vlad/Employees/autoload.php';
    $controller = new EmployeeController();
    $controller->Start();
    unset($controller);
?>