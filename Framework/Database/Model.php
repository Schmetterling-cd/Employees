<?php
include_once '/var/www/vlad/Employees/autoload.php';
include '/var/www/vlad/Employees/config.php';

abstract class Model
{
    protected $DB;

    public function setDB(){
		$this->DB = new Database(DB_URL,DB_USER,DB_PASSWORD,DB_NAME);
	}

    public function List($page, $mode){
        $page = ($page-1)*10;
        $request = $this->DB->EmployeeOrderBy($page,$mode);
        $page= ($page/10) +1;
        ListEmployeeView::Render($request,$page);
        unset($request);
    }
    public function Create($FirstName,$SecondName,$Birthday,$Salary){
        $this->DB->AddNewEmployee($FirstName,$SecondName,$Birthday,$Salary);
    }
    public function Update($id,$FirstName,$SecondName,$Birthday,$Salary){
        $this->DB->UpdateEmployeeInfo($FirstName,$SecondName,$Birthday,$Salary,$id);
    }
    public function Delete($id){
        $this->DB->DeleteEmployeeById($id);
    }
}
?>