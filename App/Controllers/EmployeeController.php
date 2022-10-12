<?php 
include_once '/var/www/vlad/Employees/autoload.php';

if($_POST){
    if(stripos(array_key_first($_POST), 'btnEdit') !== false){
        $id = (int)str_replace('btnEdit','',array_key_first($_POST));
        $model = new EmployeeModel();
        $model->PageSwitching(0,$id);
        unset($model);
    }
    if(stripos(array_key_first($_POST), 'btnAdd') !== false){
        $model = new EmployeeModel();
        $model->PageSwitching(1, null);
        unset($model);
    }

    if(stripos(array_key_last($_POST), 'btnCancel') !== false){
        $model = new EmployeeModel();
        $model->PageSwitching(2, null);
        unset($model);
    }

    if(stripos(array_key_last($_POST), 'btnDelete') !== false){
        $id = (int)str_replace('btnDelete','',array_key_first($_POST));
        $model = new EmployeeModel();
        $model->PageSwitching(3, $id);
        unset($model);
    }

    if(stripos(array_key_last($_POST), 'btnSaveEdit') !== false){
        $id = (int)str_replace('btnSaveEdit','',array_key_last($_POST));
        $val = array($id,$_POST["FirstName"],$_POST["SecondName"],$_POST["Birthday"],$_POST["Salary"]);
        $model = new EmployeeModel();
        $model->PageSwitching(4, $val);
        unset($model);
    }

    if(stripos(array_key_last($_POST), 'btnSaveAdd') !== false){
        $val = array($_POST["FirstName"],$_POST["SecondName"],$_POST["Birthday"],$_POST["Salary"]);
        $model = new EmployeeModel();
        $model->PageSwitching(5, $val);
        unset($model);
    }

    if(stripos(array_key_last($_POST), 'btnUp') !== false){
        $val = (int)$_COOKIE["page"];
        $val++;
        $_COOKIE["page"] = (string)$val;
        $model = new EmployeeModel();
        $model->PageSwitching(6,null);
        unset($model);
    }
}
?>