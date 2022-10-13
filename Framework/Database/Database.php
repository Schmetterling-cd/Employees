<?php

class Database
{
    protected $mysql;
    protected $name;
    protected $user;
    protected $password;
    protected $database;

    public function __construct($name,$user,$password,$database){
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->Connect();
    }

    public function Connect(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysql = new mysqli($this->name,$this->user,$this->password,$this->database);
    }

    public function AddNewEmployee($first_name, $second_name, $birthday, $salary){
        $request = sprintf("CALL AddNewEmployee ( '%s', '%s', '%s', '%s')", $this->mysql->real_escape_string($first_name), $this->mysql->real_escape_string($second_name), $this->mysql->real_escape_string($birthday), $this->mysql->real_escape_string($salary));
        $this->mysql->query($request);
    }
    
    public function DeleteEmployeeById($id){
        $request =sprintf("CALL DeleteEmployeeById (%s)",$this->mysql->real_escape_string($id));
        $select = $this->mysql->query($request);
        return $select->execute(); 
    }
    
    public function EmployeeOrderBy($page, $state){
        $request = sprintf("CALL EmployeeOrderBy ( %s, %s)",
        $this->mysql->real_escape_string($state),$this->mysql->real_escape_string($page));
        $select = $this->mysql->query($request);
        return mysqli_fetch_all($select, MYSQLI_ASSOC); 
    }

    public function SelectWorkerById($id){
        $request = sprintf("CALL SelectWorkerById ('%s')", $this->mysql->real_escape_string($id));
        $select = $this->mysql->query($request);
        return mysqli_fetch_all($select, MYSQLI_ASSOC); 
    }

    public function UpdateEmployeeInfo($first_name, $second_name, $birthday, $salary, $id){
        $request = sprintf("CALL UpdateEmployeeInfo ('%s','%s','%s','%s','%s')",$this->mysql->real_escape_string($id) , $this->mysql->real_escape_string($first_name), $this->mysql->real_escape_string($second_name), $this->mysql->real_escape_string($birthday), $this->mysql->real_escape_string($salary));
        $this->mysql->query($request);
    }
}
?>