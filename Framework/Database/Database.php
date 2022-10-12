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
        $select = $this->mysql->prepare("CALL AddNewEmployee ( ?, ?, ?, ?)");
        $select->bind_param("ssss", $first_name, $second_name, $birthday, $salary);
        $select->execute(); 
        unset($select);
    }
    
    public function DeleteEmployeeById($id){
        $select = $this->mysql->prepare("CALL DeleteEmployeeById (?)");
        $select->bind_param("i", $id);
        return $select->execute(); 
    }
    
    public function EmployeeOrderBy($state, $from, $to){
        $select = $this->mysql->prepare("CALL EmployeeOrderBy ( ?, ?, ?)");
        $select->bind_param("is", $state, $from, $to);
        return $select->execute(); 
    }

    public function SelectGroupById($from,$to){
        $select = $this->mysql->query("CALL SelectGroupById ( ${from}, ${to})");
        $result = mysqli_fetch_all($select, MYSQLI_ASSOC);;
        return $result; 
    }

    public function SelectWorkerById($id){
        $select = $this->mysql->query("CALL SelectWorkerById (${id})");
        $result = mysqli_fetch_all($select, MYSQLI_ASSOC);
        return $result; 
    }

    public function UpdateEmployeeInfo($first_name, $second_name, $birthday, $salary, $id){
        //$this->mysql->query("UPDATE `Employees` SET `First_name` = '${first_name}', `Second_name` = '${second_name}', `Birthday` = '${birthday}', `Salary` = '${salary}' WHERE id = '${id}'");
        $select = $this->mysql->prepare("CALL UpdateEmployeeInfo (?,?,?,?,?)");
        $select->bind_param("sssss", $id , $first_name, $second_name, $birthday, $salary);
        $select->execute(); 
        unset($select);
    }
}
?>