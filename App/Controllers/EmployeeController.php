<?php 
include_once '/var/www/vlad/Employees/autoload.php';

class EmployeeController{

    protected $model;

    public function __construct(){
        $this->model = new EmployeeModel();
    }

    public function Start(){
        session_start();
        $this->model->List(1,0);
    }

    public function Listener(){
        session_start();
        if($_POST["Token"] === $_SESSION["token"]){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                $this->Start();
            }   
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(stripos(array_key_first($_POST), 'btnEdit') !== false){
                    $id = (int)str_replace('btnEdit','',array_key_first($_POST));
                    $this->PageSwitching(0,$id);
                }
                if(stripos(array_key_first($_POST), 'btnAdd') !== false){
                    $this->PageSwitching(1, null);
                }
            
                if(isset($_POST['btnCancel'])){
                    $this->PageSwitching(2, null);
                }
            
                if(stripos(array_key_first($_POST), 'btnDelete') !== false){
                    $id = (int)str_replace('btnDelete','',array_key_first($_POST));
                    $this->PageSwitching(3, $id);
                }
            
                if(stripos(array_key_last($_POST), 'btnSaveEdit') !== false){
                    $id = (int)str_replace('btnSaveEdit','',array_key_last($_POST));
                    $val = array($id,$_POST["FirstName"],$_POST["SecondName"],$_POST["Birthday"],$_POST["Salary"]);
                    $this->PageSwitching(4, $val);
                }
            
                if(isset($_POST['btnSaveAdd'])){
                    $val = array($_POST["FirstName"],$_POST["SecondName"],$_POST["Birthday"],$_POST["Salary"]);
                    $this->PageSwitching(5, $val);
                }
            
                if(isset($_POST["btnUp"])){
                    $this->PageSwitching(6,null);
                }
            
                if(isset($_POST["btnDown"])){
                    $this->PageSwitching(7,null);
                }
            }
        }
    }

    public function PageSwitching($process, $val){
        switch ($process){
            case 0:
                $EmployeeList = $this->DB->SelectWorkerById($val);
                EditEmployeeView::Render($EmployeeList[0]);
                break;
            case 1:
                AddEmployeeView::Render();
                break;
            case 2:
                $this->model->List(1,0);
                break;
            case 3:
                $this->model->Delete($val);
                $page = (int)$_POST['Page'];
                $mode = $this->Order($_POST["OrderBy"]);
                $this->model->List($page,$mode);
                break;
            case 4:
                $this->model->Update($val[0],$val[1],$val[2],$val[3],$val[4]);
                $page = intdiv((int)$val[0], 10);
                $page++;
                $this->model->List($page,0);
                break;
            case 5:
                $this->model->Create($val[0],$val[1],$val[2],$val[3]);
                $this->model->List(1,0);
                break;
            case 6:
                $page = (int)$_POST['Page'];
                $page++;
                $mode = $this->Order($_POST["OrderBy"]);
                $this->model->List($page,$mode);
                break;
            case 7:
                $page = (int)$_POST['Page'];
                if($page>1){
                    $page--;
                }
                $mode = $this->Order($_POST["OrderBy"]);
                $this->model->List($page,$mode);
                break;
        }
    }

    protected function Order($SortMode):int{
        switch ($SortMode){
            case "IdASC":
                $DBmode = 0;
                break;
            case "IdDSC":
                $DBmode = 1;
                break;
            case "FirstNameASC":
                $DBmode = 2;
                break;
            case "FirstNameDSC":
                $DBmode = 3;
                break;
            case "SecondNameASC":
                $DBmode = 4;
                break;
            case "SecondNameASC":
                $DBmode = 5;
                break;
            case "BirthdayASC":
                $DBmode = 6;
                break;
            case "BirthdayDSC":
                $DBmode = 7;
                break;
            case "SalaryASC":
                $DBmode = 8;
                break;
            case "SalaryDSC":
                $DBmode = 9;
                break;
        }

        return $DBmode;
    }

    static function TokinGenerator():string{
        $token = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
        return $token;
    }
}
?>