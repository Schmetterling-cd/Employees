<?php 
    include_once '/var/www/vlad/Employees/autoload.php';
    $model = new EmployeeModel();
    $model->Start();
    unset($model);
    ?>