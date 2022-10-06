<?php

class MySQL_DB
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
    }

    public function Connect(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysql = new mysqli($this->name,$this->user,$this->password,$this->database);
    }

    public function Select_group_by_id($from,$to){
        $select = $this->mysql->prepare("SELECT * FROM `Employees` WHERE (id >= ? AND id < ?)");
        $select->bind_param("is", $from,$to);
        return $select->execute(); 
    }

    public function Select_worker_by_id($id){
        $select = $this->mysql->prepare("SELECT * FROM `Employees` WHERE id =  ?");
        $select->bind_param("is", $id);
        return $select->execute(); 
    }

    // public function Update($view,$value,$id){
    //     $select = $this->mysql->prepare("UPDATE `Employees` SET `?`='?' WHERE id = ?;");
    //     $select->bind_param("is",$view, $value, $id);
    //     return $select->execute(); 
    // }

    public function Update($first_name, $second_name, $birthday, $salary, $id){
        $select = $this->mysql->prepare("UPDATE `Employees` SET `First_name`='?',`Second_name`='?',`Birthday`='?',`Salary`='?' WHERE id`='?'");
        $select->bind_param("is", $first_name, $second_name, $birthday, $salary, $id);
        return $select->execute(); 
    }
}
?>